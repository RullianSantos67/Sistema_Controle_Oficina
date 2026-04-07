<?php
    require 'config/conexaoBD.php';

try {
    // O comando JOIN junta as informações do veículo com as do cliente dono dele
    $sql = "SELECT v.id_veiculo, v.placa, v.marca, v.modelo, v.ano, c.nome as nome_dono 
            FROM veiculo v
            JOIN cliente c ON v.id_cliente = c.id_cliente
            ORDER BY v.id_veiculo DESC";
            
    $veiculos = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar os veículos: " . $e->getMessage());
}

        require 'includes/cabecalho.php'; 
?>

<div class="cartao">
    <h3>🚗 Veículos Cadastrados</h3>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Veículo</th>
                <th>Ano</th>
                <th>Proprietário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
                <tr>
                    <td> <?= $veiculo['id_veiculo'] ?> </td>
                    <td> <b><?= htmlspecialchars($veiculo['placa']) ?></b> </td>
                    <td> <?= htmlspecialchars($veiculo['marca']) ?> <?= htmlspecialchars($veiculo['modelo']) ?> </td>
                    <td> <?= $veiculo['ano'] ?> </td>
                    <td> 👤 <?= htmlspecialchars($veiculo['nome_dono']) ?> </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (count($veiculos) == 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">Nenhum veículo cadastrado ainda.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <a href="cadastrar_veiculo.php" class="btn" style="width: auto; padding: 10px 20px; margin-top: 20px;">➕ Cadastrar Novo Veículo</a>
</div>

<?php require 'includes/rodape.php';
 ?>