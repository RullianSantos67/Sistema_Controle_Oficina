<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>📦 Nova Peça</h3>
    <form action="index.php?controller=peca&action=cadastrar" method="POST">
        <div class="grupo-input"><label>Descrição:</label><input type="text" name="descricao" required></div>
        <div class="flex-row">
            <div class="grupo-input flex-1"><label>Preço (R$):</label><input type="number" step="0.01" name="preco_base" required></div>
            <div class="grupo-input flex-1"><label>Quantidade:</label><input type="number" name="quantidade" required></div>
        </div>
        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue" style="padding: 10px 20px; width: auto;">Salvar Peça</button>
    
    <a href="index.php?controller=peca&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Cancelar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>