<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>👨‍🔧 Equipe de Mecânicos</h3>
    <a href="index.php?controller=mecanico&action=cadastrar" class="btn btn-add">➕ Cadastrar Mecânico</a>
    <table>
        <thead><tr><th>ID</th><th>Nome</th><th>Especialidade</th><th>Ações</th></tr></thead>
        <tbody>
            <?php foreach ($mecanicos as $m): ?>
                <tr>
                    <td>#<?= $m['id_mecanico'] ?></td>
                    <td><b><?= htmlspecialchars($m['nome']) ?></b></td>
                    <td><?= htmlspecialchars($m['especialidade']) ?></td>
                    <td>
                        <a href="index.php?controller=mecanico&action=editar&id=<?= $m['id_mecanico'] ?>" class="btn-acao-editar">Editar</a>
                        <a href="index.php?controller=mecanico&action=excluir&id=<?= $m['id_mecanico'] ?>" onclick="return confirm('Excluir funcionário?');" class="btn-acao-excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>