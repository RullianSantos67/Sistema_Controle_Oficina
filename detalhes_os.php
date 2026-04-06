<?php
require 'conexaoBD.php';
$mensagem = "";

// Pega o ID da OS na URL (Ex: detalhes_os.php?id=1)
$id_os = $_GET['id'] ?? 0;

// 1. PROCESSAR FORMULÁRIOS (Adicionar Peça ou Serviço)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Se o formulário enviado for o de PEÇAS
    if (isset($_POST['id_peca'])) {
        $id_peca = $_POST['id_peca'];
        $qtd = $_POST['quantidade'];

        try {
            // Busca o preço base da peça para gravar o histórico
            $stmt = $conexao->prepare("SELECT preco_base, quantidade_estoque FROM peca WHERE id_peca = ?");
            $stmt->execute([$id_peca]);
            $peca = $stmt->fetch();

            if($peca['quantidade_estoque'] < $qtd) {
                $mensagem = "<div class='alerta erro'>❌ Estoque insuficiente!</div>";
            } else {
                // Insere na tabela Associativa (OS_PECA)
                $conexao->prepare("INSERT INTO os_peca (id_os, id_peca, quantidade, preco_unitario) VALUES (?, ?, ?, ?)")
                        ->execute([$id_os, $id_peca, $qtd, $peca['preco_base']]);
                
                // Atualiza o estoque da peça (Tira do estoque)
                $conexao->prepare("UPDATE peca SET quantidade_estoque = quantidade_estoque - ? WHERE id_peca = ?")
                        ->execute([$qtd, $id_peca]);
                
                $mensagem = "<div class='alerta sucesso'>✅ Peça adicionada à O.S.!</div>";
            }
        } catch (Exception $e) { $mensagem = "<div class='alerta erro'>Erro: " . $e->getMessage() . "</div>"; }
    }

    // Se o formulário enviado for o de SERVIÇOS
    if (isset($_POST['id_servico'])) {
        $id_servico = $_POST['id_servico'];
        $horas = $_POST['horas'];

        try {
            $stmt = $conexao->prepare("SELECT valor_hora FROM servico WHERE id_servico = ?");
            $stmt->execute([$id_servico]);
            $servico = $stmt->fetch();

            $valor_cobrado = $servico['valor_hora'] * $horas;

            // Insere na tabela Associativa (OS_SERVICO)
            $conexao->prepare("INSERT INTO os_servico (id_os, id_servico, horas_gastas, valor_cobrado) VALUES (?, ?, ?, ?)")
                    ->execute([$id_os, $id_servico, $horas, $valor_cobrado]);
            
            $mensagem = "<div class='alerta sucesso'>✅ Serviço adicionado à O.S.!</div>";
        } catch (Exception $e) { $mensagem = "<div class='alerta erro'>Erro: " . $e->getMessage() . "</div>"; }
    }

    // Recalcula o TOTAL GERAL da O.S.
    $totalPecas = $conexao->query("SELECT SUM(quantidade * preco_unitario) FROM os_peca WHERE id_os = $id_os")->fetchColumn() ?: 0;
    $totalServicos = $conexao->query("SELECT SUM(valor_cobrado) FROM os_servico WHERE id_os = $id_os")->fetchColumn() ?: 0;
    $totalGeral = $totalPecas + $totalServicos;
    
    $conexao->prepare("UPDATE ordem_servico SET valor_total = ? WHERE id_os = ?")->execute([$totalGeral, $id_os]);
}

// 2. BUSCAR DADOS PARA EXIBIR NA TELA
$os = $conexao->query("SELECT * FROM ordem_servico WHERE id_os = $id_os")->fetch(PDO::FETCH_ASSOC);
$listaPecas = $conexao->query("SELECT * FROM peca WHERE quantidade_estoque > 0")->fetchAll();
$listaServicos = $conexao->query("SELECT * FROM servico")->fetchAll();
$pecas_usadas = $conexao->query("SELECT p.descricao, op.quantidade, op.preco_unitario FROM os_peca op JOIN peca p ON op.id_peca = p.id_peca WHERE op.id_os = $id_os")->fetchAll();
$servicos_feitos = $conexao->query("SELECT s.descricao, os.horas_gastas, os.valor_cobrado FROM os_servico os JOIN servico s ON os.id_servico = s.id_servico WHERE os.id_os = $id_os")->fetchAll();

require 'cabecalho.php'; 
?>

<div class="cartao">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 20px;">
        <h3 style="border: none; margin: 0;">🛠️ Gestão da O.S. #<?= str_pad($id_os, 4, '0', STR_PAD_LEFT) ?></h3>
        <h2 style="color: #16a34a;">TOTAL: R$ <?= number_format($os['valor_total'], 2, ',', '.') ?></h2>
    </div>

    <?= $mensagem ?>

    <div style="display: flex; gap: 30px; flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 300px; background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #cbd5e1;">
            <h4 style="margin-bottom: 15px; color: #0f172a;">📦 Adicionar Peça do Estoque</h4>
            <form method="POST">
                <select name="id_peca" required class="grupo-input">
                    <option value="">-- Escolha a Peça --</option>
                    <?php foreach($listaPecas as $p): ?>
                        <option value="<?= $p['id_peca'] ?>"><?= $p['descricao'] ?> (Estoque: <?= $p['quantidade_estoque'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="quantidade" placeholder="Quantidade usada" min="1" required class="grupo-input">
                <button type="submit" class="btn" style="padding: 10px;">+ Lançar Peça</button>
            </form>
            
            <table style="font-size: 13px; margin-top: 15px;">
                <tr><th>Peça</th><th>Qtd</th><th>Subtotal</th></tr>
                <?php foreach($pecas_usadas as $pu): ?>
                    <tr>
                        <td><?= $pu['descricao'] ?></td>
                        <td><?= $pu['quantidade'] ?></td>
                        <td>R$ <?= number_format($pu['quantidade'] * $pu['preco_unitario'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div style="flex: 1; min-width: 300px; background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #cbd5e1;">
            <h4 style="margin-bottom: 15px; color: #0f172a;">⚙️ Adicionar Mão de Obra</h4>
            <form method="POST">
                <select name="id_servico" required class="grupo-input">
                    <option value="">-- Escolha o Serviço --</option>
                    <?php foreach($listaServicos as $s): ?>
                        <option value="<?= $s['id_servico'] ?>"><?= $s['descricao'] ?> (R$ <?= $s['valor_hora'] ?>/h)</option>
                    <?php endforeach; ?>
                </select>
                <input type="number" step="0.5" name="horas" placeholder="Horas gastas (Ex: 1.5)" min="0.5" required class="grupo-input">
                <button type="submit" class="btn" style="padding: 10px; background-color: #f59e0b;">+ Lançar Serviço</button>
            </form>

            <table style="font-size: 13px; margin-top: 15px;">
                <tr><th>Serviço</th><th>Tempo</th><th>Subtotal</th></tr>
                <?php foreach($servicos_feitos as $sf): ?>
                    <tr>
                        <td><?= $sf['descricao'] ?></td>
                        <td><?= $sf['horas_gastas'] ?>h</td>
                        <td>R$ <?= number_format($sf['valor_cobrado'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
<?php require 'rodape.php'; ?>