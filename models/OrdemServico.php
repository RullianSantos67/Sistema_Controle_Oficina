<?php
class OrdemServico {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    // Lista todas as O.S. com nomes de clientes e placas dos veículos
    public function consultarOS() {
        $sql = "SELECT os.id_os, os.data_entrada, os.status, os.valor_total, v.placa, c.nome as cliente 
                FROM ordem_servico os 
                JOIN veiculo v ON os.id_veiculo = v.id_veiculo 
                JOIN cliente c ON v.id_cliente = c.id_cliente 
                ORDER BY os.id_os DESC";
        return $this->conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca os dados básicos de uma O.S. específica
    public function consultarOsID($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM ordem_servico WHERE id_os = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Métodos para preencher formulários
    public function obterVeiculos() {
        return $this->conexao->query("SELECT v.id_veiculo, v.placa, v.modelo, c.nome FROM veiculo v JOIN cliente c ON v.id_cliente = c.id_cliente")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterMecanicos() {
        return $this->conexao->query("SELECT * FROM mecanico")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria a O.S. inicial
    public function cadastrar($dados) {
        $sql = "INSERT INTO ordem_servico (data_entrada, data_previsao, status, id_veiculo, id_mecanico, valor_total) 
                VALUES (:entrada, :previsao, :status, :veiculo, :mecanico, 0)";
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute($dados);
    }

    // --- GESTÃO DE ITENS (PEÇAS E SERVIÇOS) ---

    public function listarPecasDisponiveis() {
        return $this->conexao->query("SELECT * FROM peca WHERE quantidade_estoque > 0")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarServicosDisponiveis() {
        return $this->conexao->query("SELECT * FROM servico")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pecasDaOs($id_os) {
        $sql = "SELECT p.descricao, op.quantidade, op.preco_unitario 
                FROM os_peca op 
                JOIN peca p ON op.id_peca = p.id_peca 
                WHERE op.id_os = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id_os]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function servicosDaOs($id_os) {
        $sql = "SELECT s.descricao, os.horas_gastas, os.valor_cobrado 
                FROM os_servico os 
                JOIN servico s ON os.id_servico = s.id_servico 
                WHERE os.id_os = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id_os]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarPeca($id_os, $id_peca, $qtd) {
        $peca = $this->conexao->query("SELECT preco_base, quantidade_estoque FROM peca WHERE id_peca = $id_peca")->fetch();
        
        if($peca['quantidade_estoque'] < $qtd) {
            throw new Exception("Estoque insuficiente para esta peça!");
        }

        // Insere na O.S.
        $stmt = $this->conexao->prepare("INSERT INTO os_peca (id_os, id_peca, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_os, $id_peca, $qtd, $peca['preco_base']]);

        // Baixa no estoque
        $upd = $this->conexao->prepare("UPDATE peca SET quantidade_estoque = quantidade_estoque - ? WHERE id_peca = ?");
        $upd->execute([$qtd, $id_peca]);
    }

    public function adicionarServico($id_os, $id_servico, $horas) {
        $servico = $this->conexao->query("SELECT valor_hora FROM servico WHERE id_servico = $id_servico")->fetch();
        $valor_total_servico = $servico['valor_hora'] * $horas;

        $stmt = $this->conexao->prepare("INSERT INTO os_servico (id_os, id_servico, horas_gastas, valor_cobrado) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_os, $id_servico, $horas, $valor_total_servico]);
    }

    public function atualizarValorTotal($id_os) {
        $totalPecas = $this->conexao->query("SELECT SUM(quantidade * preco_unitario) FROM os_peca WHERE id_os = $id_os")->fetchColumn() ?: 0;
        $totalServicos = $this->conexao->query("SELECT SUM(valor_cobrado) FROM os_servico WHERE id_os = $id_os")->fetchColumn() ?: 0;
        
        $novoTotal = $totalPecas + $totalServicos;
        
        $stmt = $this->conexao->prepare("UPDATE ordem_servico SET valor_total = ? WHERE id_os = ?");
        $stmt->execute([$novoTotal, $id_os]);
    }

    // --- FUNÇÃO DE CONCLUSÃO ---
    public function concluirOS($id_os) {
        $stmt = $this->conexao->prepare("UPDATE ordem_servico SET status = 'Concluída' WHERE id_os = ?");
        return $stmt->execute([$id_os]);
    }
}
?>