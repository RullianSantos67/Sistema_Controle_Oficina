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
        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>