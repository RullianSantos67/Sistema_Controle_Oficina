<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>👥 Clientes Cadastrados</h3>
    
    <a href="index.php?controller=cliente&action=cadastrar" class="btn btn-add">➕ Novo Cliente</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nome</th><th>CPF</th><th>Telefone</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cli){ ?>
                <tr>
                    <td><?= $cli['id_cliente'] ?></td>
                    <td><b><?= htmlspecialchars($cli['nome']) ?></b></td>
                    <td><?= htmlspecialchars($cli['cpf']) ?></td>
                    <td><?= htmlspecialchars($cli['telefone']) ?></td>
                    <td>
                        <a href="index.php?controller=cliente&action=editar&id=<?= $cli['id_cliente'] ?>" class="btn-acao-editar">Editar</a>
                        <a href="index.php?controller=cliente&action=excluir&id=<?= $cli['id_cliente'] ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn-acao-excluir">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>