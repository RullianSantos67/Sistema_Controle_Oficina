<?php require 'includes/cabecalho.php'; ?>
<div class="cartao card-lg">
    <h3>🛠️ Ordens de Serviço</h3>
    <a href="index.php?controller=os&action=cadastrar" class="btn btn-add">📝 Abrir Nova O.S.</a>
    <table>
        <thead><tr><th>Nº O.S.</th><th>Data</th><th>Veículo</th><th>Cliente</th><th>Total</th><th>Status</th></tr></thead>
        <tbody>
            <?php foreach ($ordens as $os): ?>
                <tr>
                    <td><b>#<?= str_pad($os['id_os'], 4, '0', STR_PAD_LEFT) ?></b></td>
                    <td><?= date("d/m/Y", strtotime($os['data_entrada'])) ?></td>
                    <td><?= htmlspecialchars($os['placa']) ?></td>
                    <td><?= htmlspecialchars($os['cliente']) ?></td>
                    <td>R$ <?= number_format($os['valor_total'] ?? 0, 2, ',', '.') ?></td>
                    <td>
                        <?= $os['status'] ?><br>
                        <a href="index.php?controller=os&action=detalhes&id=<?= $os['id_os'] ?>" style="background: #0284c7; color: white; padding: 3px 8px; border-radius: 5px; text-decoration: none; font-size: 11px;">+ Detalhes</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require 'includes/rodape.php'; ?>