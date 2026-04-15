<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>📝 Abrir Ordem de Serviço</h3>
    <form method="POST" action="index.php?controller=os&action=cadastrar">
        <div class="grupo-input">
            <label>Veículo:</label>
            <select name="id_veiculo" required>
                <?php foreach ($veiculos as $v): ?>
                    <option value="<?= $v['id_veiculo'] ?>"><?= $v['placa'] ?> - <?= $v['modelo'] ?> (<?= $v['nome'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex-row">
            <div class="grupo-input flex-1">
                <label>Mecânico:</label>
                <select name="id_mecanico" required>
                    <?php foreach ($mecanicos as $m): ?><option value="<?= $m['id_mecanico'] ?>"><?= $m['nome'] ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="grupo-input flex-1">
                <label>Status Inicial:</label>
                <select name="status" required>
                    <option value="Aberta">Aberta</option><option value="Em Andamento">Em Andamento</option>
                </select>
            </div>
        </div>
        <div class="grupo-input"><label>Previsão de Entrega:</label><input type="date" name="data_previsao" required></div>
        <button type="submit" class="btn">Gerar O.S.</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>