<?php
        require 'config/conexaoBD.php';
$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $preco_base = $_POST['preco_base'];
    $quantidade = $_POST['quantidade'];

    try {
        $sql = "INSERT INTO peca (descricao, preco_base, quantidade_estoque) VALUES (:descr, :preco, :qtd)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':descr' => $descricao,
            ':preco' => $preco_base,
            ':qtd'   => $quantidade
        ]);
        $mensagem = "<div class='alerta sucesso'>✅ Peça <b>$descricao</b> adicionada ao stock!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro ao cadastrar peça: " . $e->getMessage() . "</div>";
    }
}

    require 'includes/cabecalho.php'; 
?>

<div class="cartao" style="max-width: 600px;">
    <h3>📦 Registar Nova Peça</h3>
    <?= $mensagem ?>

    <form method="POST">
        <div class="grupo-input">
            <label>Descrição da Peça</label>
            <input type="text" name="descricao" placeholder="Ex: Pastilha de Travão Dianteira" required>
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="grupo-input" style="flex: 1;">
                <label>Preço Base (Custo)</label>
                <input type="number" name="preco_base" step="0.01" placeholder="0.00" required>
            </div>
            
            <div class="grupo-input" style="flex: 1;">
                <label>Quantidade em Stock</label>
                <input type="number" name="quantidade" placeholder="Ex: 10" required>
            </div>
        </div>

        <button type="submit" class="btn">Guardar no Inventário</button>
    </form>
</div>

<?php require 'includes/rodape.php'; ?>