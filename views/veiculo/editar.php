<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>✏️ Editar Veículo</h3>
    
    <form action="index.php?controller=veiculo&action=editar&id=<?= $veiculo['id_veiculo'] ?>" method="POST">
        <div class="grupo-input">
            <label>Proprietário:</label>
            <select name="id_cliente" required>
                <?php foreach ($clientes as $cli): ?>
                    <option value="<?= $cli['id_cliente'] ?>" <?= ($cli['id_cliente'] == $veiculo['id_cliente']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cli['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grupo-input">
            <label>Placa:</label>
            <input type="text" name="placa" class="input-form" value="<?= htmlspecialchars($veiculo['placa']) ?>" required>
        </div>

        <div class="flex-row">
            <div class="grupo-input" style="flex: 1;">
                <label>Marca:</label>
                <input type="text" name="marca" class="input-form" value="<?= htmlspecialchars($veiculo['marca']) ?>" required>
            </div>
            <div class="grupo-input" style="flex: 1;">
                <label>Modelo:</label>
                <input type="text" name="modelo" class="input-form" value="<?= htmlspecialchars($veiculo['modelo']) ?>" required>
            </div>
        </div>

        <div class="grupo-input">
            <label>Ano:</label>
            <input type="number" name="ano" class="input-form" value="<?= $veiculo['ano'] ?>" required>
        </div>

        <button type="submit" class="btn btn-edit" style="width: 100%; padding: 12px; font-size: 15px;">Atualizar Dados</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>