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
       <button type="submit" class="btn btn-blue" style="margin-top: 15px;">Salvar Mecânico</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>