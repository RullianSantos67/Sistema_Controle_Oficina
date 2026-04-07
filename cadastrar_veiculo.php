<?php
        require 'config/conexaoBD.php';
$mensagem = ""; 

// 1. Busca todos os clientes para colocar na lista de seleção (dropdown)
try {
    $clientes = $conexao->query("SELECT id_cliente, nome FROM cliente ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar clientes: " . $e->getMessage());
}

// 2. Verifica se o formulário foi enviado para salvar o veículo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // strtoupper deixa a placa em letras maiúsculas automaticamente
    $placa = strtoupper($_POST['placa']); 
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $id_cliente = $_POST['id_cliente'];

    try {
        $sql = "INSERT INTO veiculo (placa, marca, modelo, ano, id_cliente) VALUES (:placa, :marca, :modelo, :ano, :id_cliente)";
        $stmt = $conexao->prepare($sql);
        
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':id_cliente', $id_cliente);
        
        $stmt->execute();
        $mensagem = "<div class='alerta sucesso'>✅ Veículo <b>$modelo ($placa)</b> cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alerta erro'>❌ Erro (Essa placa já está cadastrada?): " . $e->getMessage() . "</div>";
    }
}

    require 'includes/cabecalho.php'; // Puxa o visual do sistema
?>

<div class="cartao" style="max-width: 600px;">
    <h3>🚗 Cadastrar Novo Veículo</h3>
    <?= $mensagem ?>

    <form method="POST" action="cadastrar_veiculo.php">
        
        <div class="grupo-input">
            <label>Proprietário do Veículo (Cliente)</label>
            <select name="id_cliente" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; background: white; font-size: 15px;">
                <option value="">-- Selecione o dono --</option>
                <?php foreach ($clientes as $cli): ?>
                    <option value="<?= $cli['id_cliente'] ?>"><?= htmlspecialchars($cli['nome']) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if(count($clientes) == 0): ?>
                <small style="color: red;">Você precisa cadastrar um cliente primeiro!</small>
            <?php endif; ?>
        </div>

        <div class="grupo-input">
            <label>Placa</label>
            <input type="text" name="placa" id="placa" placeholder="ABC-1234 ou ABC1D23" maxlength="8" required>
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="grupo-input" style="flex: 1;">
                <label>Marca</label>
                <input type="text" name="marca" placeholder="Ex: Volkswagen" required>
            </div>
            
            <div class="grupo-input" style="flex: 1;">
                <label>Modelo</label>
                <input type="text" name="modelo" placeholder="Ex: Gol G4" required>
            </div>
        </div>

        <div class="grupo-input">
            <label>Ano do Veículo</label>
            <input type="number" name="ano" placeholder="Ex: 2012" min="1950" max="2027" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 15px;" required>
        </div>

        <button type="submit" class="btn">Salvar Veículo</button>
    </form>
</div>

<script>
    document.getElementById('placa').addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        if (value.length > 3) {
            value = value.substring(0, 3) + '-' + value.substring(3, 7);
        }
        e.target.value = value;
    });
</script>

<?php require 'includes/rodape.php'; ?>