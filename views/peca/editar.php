<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>✏️ Editar Peça</h3>
    <form action="index.php?controller=peca&action=editar" method="POST">
        <input type="hidden" name="id_peca" value="<?= $peca['id_peca'] ?>">
        <div class="grupo-input"><label>Descrição:</label><input type="text" name="descricao" value="<?= htmlspecialchars($peca['descricao']) ?>" required></div>
        <div class="flex-row">
            <div class="grupo-input flex-1"><label>Preço (R$):</label><input type="number" step="0.01" name="preco_base" value="<?= $peca['preco_base'] ?>" required></div>
            <div class="grupo-input flex-1"><label>Quantidade:</label><input type="number" name="quantidade" value="<?= $peca['quantidade_estoque'] ?>" required></div>
        </div>
        <button type="submit" class="btn" style="background-color: #f59e0b; color: white; margin-top: 15px;">Atualizar Peça</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>