<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>➕ Cadastrar Cliente</h3>
    <form action="index.php?controller=cliente&action=cadastrar" method="POST">
        <div class="grupo-input">
            <label>Nome Completo:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="grupo-input">
            <label>CPF:</label>
            <input type="text" name="cpf" maxlength="14" required>
        </div>
        <div class="grupo-input">
            <label>Telefone:</label>
            <input type="text" name="telefone" maxlength="15">
        </div>
        <button type="submit" class="btn">Salvar Cliente</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>