<?php
        require 'config/conexaoBD.php';

try {
    $sql = "SELECT os.id_os, os.data_entrada, os.data_previsao, os.status, 
                   v.placa, v.modelo, c.nome as cliente, m.nome as mecanico
            FROM ordem_servico os
            JOIN veiculo v ON os.id_veiculo = v.id_veiculo
            JOIN cliente c ON v.id_cliente = c.id_cliente
            JOIN mecanico m ON os.id_mecanico = m.id_mecanico
            ORDER BY os.id_os DESC";
            
    $ordens = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

    require 'includes/cabecalho.php'; 
?>

<div class="cartao" style="max-width: 1000px;">
    <h3>🛠️ Ordens de Serviço</h3>
    
    <table>
        <thead>
            <tr>
                <th>Nº O.S.</th>
                <th>Data Entrada</th>
                <th>Previsão</th>
                <th>Veículo</th>
                <th>Cliente</th>
                <th>Status / Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordens as $os): 
                // Formatação das datas de padrão Americano (YYYY-MM-DD) para Brasileiro (DD/MM/YYYY)
                $entrada = date("d/m/Y", strtotime($os['data_entrada']));
                $previsao = date("d/m/Y", strtotime($os['data_previsao']));
            ?>
                <tr>
                    <td><b>#<?= str_pad($os['id_os'], 4, '0', STR_PAD_LEFT) ?></b></td>
                    <td><?= $entrada ?></td>
                    <td><?= $previsao ?></td>
                    <td><?= htmlspecialchars($os['modelo']) ?> (<?= htmlspecialchars($os['placa']) ?>)</td>
                    <td><?= htmlspecialchars($os['cliente']) ?></td>
                    <td>
                        <span style="padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; background-color: <?= $os['status'] == 'Aberta' ? '#fef08a; color: #854d0e' : '#e0e7ff; color: #3730a3' ?>;">
                            <?= htmlspecialchars($os['status']) ?>
                        </span>
                        
                        <br><br>
                        <a href="detalhes_os.php?id=<?= $os['id_os'] ?>" style="background: #0284c7; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-size: 12px; font-weight: bold;">Ver Detalhes -></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (count($ordens) == 0): ?>
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Nenhuma O.S. cadastrada no momento.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <a href="cadastrar_os.php" class="btn" style="width: auto; padding: 10px 20px; margin-top: 20px;">📝 Abrir Nova O.S.</a>
</div>

<?php require 'includes/rodape.php'; ?>