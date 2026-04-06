<?php
require 'conexaoBD.php';
$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $valor_hora = $_POST['valor_hora'];

    try {
        $sql = "INSERT INTO servico (descricao, valor_hora) VALUES (:descr, :valor)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':descr' => $descricao, ':valor' => $valor_hora]);
        $mensagem = "<div class='alerta sucesso'>✅ Serviço <b>$descricao</b> registado!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro: " . $e->getMessage() . "</div>";
    }
}
require 'cabecalho.php'; 
?>
<div class="cartao" style="max-width: 500px;">
    <h3>🛠️ Registar Mão de Obra</h3>
    <?= $mensagem ?>
    <form method="POST">
        <div class="grupo-input">
            <label>Descrição do Serviço (Ex: Alinhamento, Troca de Óleo)</label>
            <input type="text" name="descricao" required>
        </div>
        <div class="grupo-input">
            <label>Valor Cobrado por Hora (R$)</label>
            <input type="number" name="valor_hora" step="0.01" placeholder="Ex: 150.00" required>
        </div>
        <button type="submit" class="btn">Salvar Serviço</button>
    </form>
</div>
<?php require 'rodape.php'; ?>