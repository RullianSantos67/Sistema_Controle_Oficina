<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-sm">
    <h3>👨‍🔧 Novo Mecânico</h3>
    <form action="index.php?controller=mecanico&action=cadastrar" method="POST">
        <div class="grupo-input"><label>Nome do Profissional:</label><input type="text" name="nome" required></div>
        <div class="grupo-input">
            <label>Especialidade:</label>
            <select name="especialidade" required>
                <option value="Geral">Mecânica Geral</option>
                <option value="Eletricista">Eletricista Automotivo</option>
                <option value="Motor">Especialista em Motores</option>
            </select>
        </div>
       <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue" style="padding: 10px 20px; width: auto;">Salvar Mecânico</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Cancelar
    </a>
</div>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>