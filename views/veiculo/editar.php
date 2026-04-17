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

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=veiculo&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>