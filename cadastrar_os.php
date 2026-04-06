<?php
require 'conexaoBD.php';
$mensagem = ""; 

// Busca veículos e dono para o Select
$sqlVeiculos = "SELECT v.id_veiculo, v.placa, v.modelo, c.nome as dono FROM veiculo v JOIN cliente c ON v.id_cliente = c.id_cliente";
$veiculos = $conexao->query($sqlVeiculos)->fetchAll(PDO::FETCH_ASSOC);

// Busca ou cria um mecânico padrão (para evitar erros caso a tabela esteja vazia)
$mecanicos = $conexao->query("SELECT * FROM mecanico")->fetchAll(PDO::FETCH_ASSOC);
if(count($mecanicos) == 0) {
    $conexao->exec("INSERT INTO mecanico (nome, especialidade) VALUES ('Mecânico Padrão', 'Geral')");
    $mecanicos = $conexao->query("SELECT * FROM mecanico")->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_veiculo = $_POST['id_veiculo'];
    $id_mecanico = $_POST['id_mecanico'];
    $data_entrada = date('Y-m-d'); // Pega o dia de hoje
    $data_previsao = $_POST['data_previsao'];
    $status = $_POST['status'];

    try {
        $sql = "INSERT INTO ordem_servico (data_entrada, data_previsao, status, id_veiculo, id_mecanico) 
                VALUES (:entrada, :previsao, :status, :veiculo, :mecanico)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':entrada' => $data_entrada,
            ':previsao' => $data_previsao,
            ':status' => $status,
            ':veiculo' => $id_veiculo,
            ':mecanico' => $id_mecanico
        ]);
        $mensagem = "<div class='alerta sucesso'>✅ Ordem de Serviço aberta com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro ao criar O.S.: " . $e->getMessage() . "</div>";
    }
}

require 'cabecalho.php'; 
?>

<div class="cartao">
    <h3>📝 Abrir Ordem de Serviço</h3>
    <?= $mensagem ?>

    <form method="POST">
        <div class="grupo-input">
            <label>Selecione o Veículo (Placa - Modelo / Proprietário)</label>
            <select name="id_veiculo" required>
                <option value="">-- Escolha um veículo --</option>
                <?php foreach ($veiculos as $v): ?>
                    <option value="<?= $v['id_veiculo'] ?>">
                        <?= $v['placa'] ?> - <?= $v['modelo'] ?> (Dono: <?= $v['dono'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="grupo-input" style="flex: 1;">
                <label>Mecânico Responsável</label>
                <select name="id_mecanico" required>
                    <?php foreach ($mecanicos as $m): ?>
                        <option value="<?= $m['id_mecanico'] ?>"><?= $m['nome'] ?> (<?= $m['especialidade'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grupo-input" style="flex: 1;">
                <label>Status Inicial</label>
                <select name="status" required>
                    <option value="Aberta">Aberta (Aguardando análise)</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Aguardando Peças">Aguardando Peças</option>
                </select>
            </div>
        </div>

        <div class="grupo-input">
            <label>Data de Previsão de Entrega</label>
            <input type="date" name="data_previsao" required>
        </div>

        <button type="submit" class="btn">Gerar Ordem de Serviço</button>
    </form>
</div>

<?php require 'rodape.php'; ?>