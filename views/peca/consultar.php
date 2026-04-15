<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>📦 Inventário de Peças</h3>
    <a href="index.php?controller=peca&action=cadastrar" class="btn btn-add">➕ Adicionar Peça</a>
    <table>
        <thead><tr><th>ID</th><th>Descrição</th><th>Preço Base</th><th>Em Stock</th><th>Ações</th></tr></thead>
        <tbody>
            <?php foreach ($pecas as $p): ?>
                <tr>
                    <td>#<?= $p['id_peca'] ?></td>
                    <td><?= htmlspecialchars($p['descricao']) ?></td>
                    <td>R$ <?= number_format($p['preco_base'], 2, ',', '.') ?></td>
                    <td>
                        <?= $p['quantidade_estoque'] ?> un.
                        <?php if($p['quantidade_estoque'] <= 3) echo "<span style='color:red;'>(Baixo)</span>"; ?>
                    </td>
                    <td>
                        <a href="index.php?controller=peca&action=editar&id=<?= $p['id_peca'] ?>" class="btn-acao-editar">Editar</a>
                        <a href="index.php?controller=peca&action=excluir&id=<?= $p['id_peca'] ?>" onclick="return confirm('Excluir peça?');" class="btn-acao-excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>