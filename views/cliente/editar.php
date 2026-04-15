<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>✏️ Editar Cliente</h3>
    <form method="POST" action="index.php?controller=cliente&action=editar">
      <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
      
      <div class="grupo-input">
          <label>Nome do Cliente:</label>
          <input type="text" name="nome" required value="<?= htmlspecialchars($cliente['nome']) ?>">
      </div>

      <div class="grupo-input">
          <label>CPF:</label>
          <input type="text" name="cpf" maxlength="14" required value="<?= htmlspecialchars($cliente['cpf']) ?>">
      </div>

      <div class="grupo-input">
          <label>Telefone:</label>
          <input type="text" name="telefone" maxlength="15" value="<?= htmlspecialchars($cliente['telefone']) ?>">
      </div>

      <button type="submit" class="btn btn-warning">Salvar alterações</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>