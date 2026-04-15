<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>🚗 Frota de Veículos</h3>
    
    <a href="index.php?controller=veiculo&action=cadastrar" class="btn btn-blue" style="width: auto; margin-bottom: 20px;">➕ Novo Veículo</a>
    
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Marca/Modelo</th>
                <th>Ano</th>
                <th>Proprietário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $v): ?>
                <tr>
                    <td><b><?= htmlspecialchars($v['placa']) ?></b></td>
                    <td><?= htmlspecialchars($v['marca']) ?> <?= htmlspecialchars($v['modelo']) ?></td>
                    <td><?= $v['ano'] ?></td>
                    <td>👤 <?= htmlspecialchars($v['dono']) ?></td>
                    <td>
                        <a href="index.php?controller=veiculo&action=editar&id=<?= $v['id_veiculo'] ?>" class="btn-edit">Editar</a>
                        <a href="index.php?controller=veiculo&action=excluir&id=<?= $v['id_veiculo'] ?>" class="btn-delete" onclick="return confirm('Deseja remover este veículo?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>