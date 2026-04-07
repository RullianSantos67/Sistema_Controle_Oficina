<?php
require 'config/conexaoBD.php';
$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    try {
        $sql = "INSERT INTO mecanico (nome, especialidade) VALUES (:nome, :esp)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':nome' => $nome, ':esp' => $especialidade]);
        $mensagem = "<div class='alerta sucesso'>✅ Mecânico <b>$nome</b> cadastrado!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro: " . $e->getMessage() . "</div>";
    }
}
            require 'includes/cabecalho.php'; 
?>
<div class="cartao" style="max-width: 500px;">
    <h3>👨‍🔧 Registar Mecânico</h3>
    <?= $mensagem ?>
    <form method="POST">
        <div class="grupo-input">
            <label>Nome do Profissional</label>
            <input type="text" name="nome" required>
        </div>
        <div class="grupo-input">
            <label>Especialidade</label>
            <select name="especialidade" required>
                <option value="Geral">Mecânica Geral</option>
                <option value="Eletricista">Eletricista Automotivo</option>
                <option value="Suspensão">Suspensão e Freios</option>
                <option value="Motor">Especialista em Motores</option>
            </select>
        </div>
        <button type="submit" class="btn">Salvar Mecânico</button>
    </form>
</div>
<?php require 'includes/rodape.php'; ?>