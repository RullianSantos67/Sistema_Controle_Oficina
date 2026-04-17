<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>⚙️ Novo Serviço</h3>
    <form action="index.php?controller=servico&action=cadastrar" method="POST">
        <div class="grupo-input"><label>Descrição (Ex: Troca de Óleo):</label><input type="text" name="descricao" required></div>
        <div class="grupo-input"><label>Valor por Hora (R$):</label><input type="number" step="0.01" name="valor_hora" required></div>
        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue" style="padding: 10px 20px; width: auto;">Salvar Serviço</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Cancelar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>