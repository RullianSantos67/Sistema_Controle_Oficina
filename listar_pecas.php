<?php
require 'conexaoBD.php';

try {
    $pecas = $conexao->query("SELECT * FROM peca ORDER BY descricao ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

require 'cabecalho.php'; 
?>

<div class="cartao">
    <h3>📦 Inventário de Peças</h3>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Preço Base</th>
                <th>Em Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pecas as $p): ?>
                <tr>
                    <td> #<?= $p['id_peca'] ?> </td>
                    <td> <?= htmlspecialchars($p['descricao']) ?> </td>
                    <td> R$ <?= number_format($p['preco_base'], 2, ',', '.') ?> </td>
                    <td> <?= $p['quantidade_estoque'] ?> un. </td>
                    <td>
                        <?php if($p['quantidade_estoque'] <= 3): ?>
                            <span style="color: #dc2626; font-weight: bold;">⚠️ Stock Baixo</span>
                        <?php else: ?>
                            <span style="color: #16a34a;">✅ Disponível</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (count($pecas) == 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">Nenhuma peça registada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <a href="cadastrar_peca.php" class="btn" style="width: auto; padding: 10px 20px; margin-top: 20px;">➕ Adicionar Peça</a>
</div>

<?php require 'rodape.php'; ?>