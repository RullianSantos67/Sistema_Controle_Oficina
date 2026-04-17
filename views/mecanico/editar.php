<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>✏️ Editar Mecânico</h3>
    <form action="index.php?controller=mecanico&action=editar" method="POST">
        <input type="hidden" name="id_mecanico" value="<?= $mecanico['id_mecanico'] ?>">
        <div class="grupo-input"><label>Nome:</label><input type="text" name="nome" value="<?= htmlspecialchars($mecanico['nome']) ?>" required></div>
        <div class="grupo-input">
            <label>Especialidade:</label>
            <select name="especialidade" required>
                <option value="Geral" <?= $mecanico['especialidade'] == 'Geral' ? 'selected' : '' ?>>Mecânica Geral</option>
                <option value="Eletricista" <?= $mecanico['especialidade'] == 'Eletricista' ? 'selected' : '' ?>>Eletricista Automotivo</option>
                <option value="Motor" <?= $mecanico['especialidade'] == 'Motor' ? 'selected' : '' ?>>Especialista em Motores</option>
            </select>
        </div>
        <button type="submit" class="btn" style="background-color: #f59e0b; color: white; margin-top: 15px;">Atualizar Mecânico</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>