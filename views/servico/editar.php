<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>✏️ Editar Serviço</h3>
    <form action="index.php?controller=servico&action=editar" method="POST">
        <input type="hidden" name="id_servico" value="<?= $servico['id_servico'] ?>">
        <div class="grupo-input"><label>Descrição:</label><input type="text" name="descricao" value="<?= htmlspecialchars($servico['descricao']) ?>" required></div>
        <div class="grupo-input"><label>Valor por Hora (R$):</label><input type="number" step="0.01" name="valor_hora" value="<?= $servico['valor_hora'] ?>" required></div>
        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>