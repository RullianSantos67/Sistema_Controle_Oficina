<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>⚙️ Novo Serviço</h3>
    <form action="index.php?controller=servico&action=cadastrar" method="POST">
        <div class="grupo-input"><label>Descrição (Ex: Troca de Óleo):</label><input type="text" name="descricao" required></div>
        <div class="grupo-input"><label>Valor por Hora (R$):</label><input type="number" step="0.01" name="valor_hora" required></div>
        <button type="submit" class="btn btn-blue" style="margin-top: 15px;">Salvar Serviço</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>