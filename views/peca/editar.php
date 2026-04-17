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
        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>