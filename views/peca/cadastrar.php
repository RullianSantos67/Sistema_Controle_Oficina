<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>📦 Nova Peça</h3>
    <form action="index.php?controller=peca&action=cadastrar" method="POST">
        <div class="grupo-input"><label>Descrição:</label><input type="text" name="descricao" required></div>
        <div class="flex-row">
            <div class="grupo-input flex-1"><label>Preço (R$):</label><input type="number" step="0.01" name="preco_base" required></div>
            <div class="grupo-input flex-1"><label>Quantidade:</label><input type="number" name="quantidade" required></div>
        </div>
        <button type="submit" class="btn">Salvar Peça</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>