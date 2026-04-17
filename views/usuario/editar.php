<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-sm">
    <h3>✏️ Editar Usuário #<?= $u['id_usuario'] ?></h3>
    
    <form action="index.php?controller=usuario&action=editar" method="POST">
        <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
        
        <div class="grupo-input">
            <label>Nome Completo:</label>
            <input type="text" name="nome" class="input-form" value="<?= $u['nome'] ?>" required>
        </div>

        <div class="grupo-input">
            <label>E-mail:</label>
            <input type="email" name="email" class="input-form" value="<?= $u['email'] ?>" required>
        </div>

        <div class="grupo-input">
            <label>Nova Senha (deixe em branco para manter a atual):</label>
            <input type="password" name="senha" class="input-form">
        </div>

        <div class="grupo-input">
            <label>Nível de Perfil:</label>
            <select name="nivel" class="input-form" required>
                <option value="Admin" <?= $u['perfil'] == 'Admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="Mecanico" <?= $u['perfil'] == 'Mecanico' ? 'selected' : '' ?>>Mecânico</option>
                <option value="Atendente" <?= $u['perfil'] == 'Atendente' ? 'selected' : '' ?>>Atendente</option>
            </select>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=usuario&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>

<?php require 'includes/rodape.php'; ?>