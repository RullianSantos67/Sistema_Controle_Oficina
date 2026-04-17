<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-sm">
    <h3>👤 Cadastrar Novo Usuário</h3>
    
    <form action="index.php?controller=usuario&action=cadastrar" method="POST">
        
        <div class="grupo-input">
            <label>Nome Completo:</label>
            <input type="text" name="nome" class="input-form" placeholder="Ex: Rullian Santos" required>
        </div>

        <div class="grupo-input">
            <label>E-mail (Login):</label>
            <input type="email" name="email" class="input-form" placeholder="admin@oficina.com" required>
        </div>

        <div class="grupo-input">
            <label>Senha de Acesso:</label>
            <input type="password" name="senha" class="input-form" placeholder="Crie uma senha forte" required>
        </div>

        <div class="grupo-input">
            <label>Nível de Perfil:</label>
            <select name="nivel" class="input-form" required>
                <option value="mecanico">Mecânico (Acesso limitado)</option>
                <option value="admin">Administrador (Acesso total)</option>
                <option value="atendente">Atendente (Acesso limitado)</option>
            </select>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue" style="padding: 10px 20px; width: auto;">Salvar Usuário</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Cancelar
    </a>
</div>
    </form>
</div>

<?php require 'includes/rodape.php'; ?>