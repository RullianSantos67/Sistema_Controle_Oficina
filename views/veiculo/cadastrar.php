<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>🚗 Registar Veículo</h3>
    
    <form action="index.php?controller=veiculo&action=cadastrar" method="POST">
        <div class="grupo-input">
            <label>Proprietário:</label>
            <select name="id_cliente" required>
                <option value="">-- Selecione o Dono --</option>
                <?php foreach ($clientes as $cli): ?>
                    <option value="<?= $cli['id_cliente'] ?>"><?= htmlspecialchars($cli['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grupo-input">
            <label>Placa:</label>
            <input type="text" name="placa" class="input-form" placeholder="ABC-1234" required>
        </div>

        <div class="flex-row">
            <div class="grupo-input" style="flex: 1;">
                <label>Marca:</label>
                <input type="text" name="marca" class="input-form" placeholder="Ex: Fiat" required>
            </div>
            <div class="grupo-input" style="flex: 1;">
                <label>Modelo:</label>
                <input type="text" name="modelo" class="input-form" placeholder="Ex: Uno" required>
            </div>
        </div>

        <div class="grupo-input">
            <label>Ano:</label>
            <input type="number" name="ano" class="input-form" placeholder="2024" required>
        </div>

        <button type="submit" class="btn btn-blue">Salvar Veículo</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>