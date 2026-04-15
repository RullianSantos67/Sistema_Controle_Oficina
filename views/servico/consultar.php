<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>⚙️ Tabela de Mão de Obra</h3>
    <a href="index.php?controller=servico&action=cadastrar" class="btn btn-add">➕ Adicionar Serviço</a>
    <table>
        <thead><tr><th>ID</th><th>Descrição</th><th>Valor / Hora</th><th>Ações</th></tr></thead>
        <tbody>
            <?php foreach ($servicos as $s): ?>
                <tr>
                    <td>#<?= $s['id_servico'] ?></td>
                    <td><b><?= htmlspecialchars($s['descricao']) ?></b></td>
                    <td>R$ <?= number_format($s['valor_hora'], 2, ',', '.') ?></td>
                    <td>
                        <a href="index.php?controller=servico&action=editar&id=<?= $s['id_servico'] ?>" class="btn-acao-editar">Editar</a>
                        <a href="index.php?controller=servico&action=excluir&id=<?= $s['id_servico'] ?>" onclick="return confirm('Excluir?');" class="btn-acao-excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>