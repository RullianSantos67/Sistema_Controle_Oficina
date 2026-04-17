<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-sm">
    <h3>✏️ Editar Ordem de Serviço #<?= str_pad($os['id_os'], 4, '0', STR_PAD_LEFT) ?></h3>
    
    <form action="index.php?controller=os&action=editar" method="POST">
        <input type="hidden" name="id_os" value="<?= $os['id_os'] ?>">
        
        <div class="grupo-input">
            <label>Veículo / Cliente:</label>
            <select name="id_veiculo" class="input-form" required>
                <?php foreach ($veiculos as $v): ?>
                    <option value="<?= $v['id_veiculo'] ?>" <?= ($v['id_veiculo'] == $os['id_veiculo']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($v['placa']) ?> - <?= htmlspecialchars($v['modelo']) ?> (<?= htmlspecialchars($v['nome']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grupo-input">
            <label>Mecânico Responsável:</label>
            <select name="id_mecanico" class="input-form" required>
                <?php foreach ($mecanicos as $m): ?>
                    <option value="<?= $m['id_mecanico'] ?>" <?= ($m['id_mecanico'] == $os['id_mecanico']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grupo-input">
            <label>Status Atual:</label>
            <select name="status" class="input-form" required>
                <option value="Em Andamento" <?= ($os['status'] == 'Em Andamento') ? 'selected' : '' ?>>Em Andamento</option>
                <option value="Aguardando Orçamento" <?= ($os['status'] == 'Aguardando Orçamento') ? 'selected' : '' ?>>Aguardando Orçamento</option>
                <option value="Aguardando Peças" <?= ($os['status'] == 'Aguardando Peças') ? 'selected' : '' ?>>Aguardando Peças</option>
                <option value="Concluída" <?= ($os['status'] == 'Concluída') ? 'selected' : '' ?>>Concluída</option>
            </select>
        </div>

        <div class="grupo-input">
            <label>Previsão de Entrega:</label>
            <input type="date" name="data_previsao" class="input-form" value="<?= $os['data_previsao'] ?>" required>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=os&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>

<?php require 'includes/rodape.php'; ?>