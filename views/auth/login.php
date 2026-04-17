<?php require 'includes/cabecalho.php'; ?>

<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.85); z-index: 5;"></div>

<div class="login-wrapper" style="position: relative; z-index: 10; display: flex; justify-content: center; align-items: center; height: 100vh; width: 100%;">
    <div class="login-card" style="background: white; padding: 40px; border-radius: 16px; width: 100%; max-width: 380px; box-shadow: 0 25px 50px rgba(0,0,0,0.5); text-align: center;">
        
        <h2 style="color: #0f172a; margin-bottom: 30px; font-size: 26px; font-weight: 800;">
            ⚙️ Auto<span style="color: #0284c7;">Mecânica</span>
        </h2>
        
        <?php if(!empty($erro)): ?>
            <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: bold; border: 1px solid #fecaca;">
                <?= $erro ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?controller=auth&action=login">
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 5px;">E-mail de Acesso</label>
                <input type="email" name="email" placeholder="admin@oficina.com" required 
                       style="width: 100%; padding: 14px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #f8fafc; box-sizing: border-box; font-family: 'Poppins', sans-serif;">
            </div>
            
            <div style="margin-bottom: 25px; text-align: left;">
                <label style="display: block; font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 5px;">Senha</label>
                <input type="password" name="senha" placeholder="••••••••" required 
                       style="width: 100%; padding: 14px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #f8fafc; box-sizing: border-box; font-family: 'Poppins', sans-serif;">
            </div>
            
            <button type="submit" 
                    style="width: 100%; padding: 15px; background: #0284c7; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 16px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px rgba(2, 132, 199, 0.3);">
                Entrar no Sistema
            </button>
        </form>
    </div>
</div>

<?php require 'includes/rodape.php'; ?>