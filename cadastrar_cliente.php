<?php
require 'config/conexaoBD.php';
$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    try {
        $sql = "INSERT INTO cliente (nome, telefone, cpf) VALUES (:nome, :telefone, :cpf)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $mensagem = "<div class='alerta sucesso'>✅ Cliente <b>$nome</b> cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro ao cadastrar (CPF já existe?): " . $e->getMessage() . "</div>";
    }
}

require 'includes/cabecalho.php';?>

<div class="cartao" style="max-width: 600px;">
    <h3>Cadastrar Novo Cliente</h3>
    <?= $mensagem ?>

    <form method="POST" action="cadastrar_cliente.php">
        <div class="grupo-input">
            <label>Nome Completo</label>
            <input type="text" name="nome" required>
        </div>
        <div class="grupo-input">
            <label>CPF</label>
            <input type="text" name="cpf" maxlength="14" required>
        </div>
        <div class="grupo-input">
            <label>Telefone / WhatsApp</label>
            <input type="text" name="telefone" maxlength="15">
        </div>
        <button type="submit" class="btn">Salvar Cadastro</button>
    </form>
</div>

    <?php require 'includes/rodape.php'; ?>