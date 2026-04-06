<?php
require 'conexaoBD.php';

try {
    $sql = "SELECT * FROM cliente";
    $clientes = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

require 'cabecalho.php'; // Puxa o visual
?>

<div class="cartao">
    <h3>👥 Clientes Cadastrados</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td> <?= $cliente['id_cliente'] ?> </td>
                    <td> <?= htmlspecialchars($cliente['nome']) ?> </td>
                    <td> <?= htmlspecialchars($cliente['cpf']) ?> </td>
                    <td> <?= htmlspecialchars($cliente['telefone']) ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require 'rodape.php'; ?>