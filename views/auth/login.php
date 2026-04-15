<?php require 'includes/cabecalho.php'; ?>
<div class="login-wrapper">
    <div class="login-card">
        <h2>⚙️ Login Oficina</h2>
        
        <?php if(!empty($erro)): ?>
            <p style="color: #dc2626; margin-bottom: 15px; font-weight: 600;"><?= $erro ?></p>
        <?php endif; ?>
        
        <form method="POST" action="index.php?controller=auth&action=login">
            <input type="email" name="email" class="input-form" placeholder="E-mail" required>
            <input type="password" name="senha" class="input-form" placeholder="Senha" required>
            <button type="submit" class="btn btn-blue" style="width: 100%;">Entrar no Sistema</button>
        </form>
    </div>
</div>