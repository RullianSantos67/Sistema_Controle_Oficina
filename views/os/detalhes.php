<?php require 'includes/cabecalho.php'; ?>

<div class="cartao">
    <div class="card-header">
        <h3>🛠️ Detalhes da Ordem de Serviço #<?= str_pad($os['id_os'], 4, '0', STR_PAD_LEFT) ?></h3>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <span style="font-size: 20px; font-weight: 800; color: #16a34a;">Total: R$ <?= number_format($os['valor_total'], 2, ',', '.') ?></span>
            
            <?php if($os['status'] != 'Concluída'): ?>
                <a href="index.php?controller=os&action=concluir&id=<?= $os['id_os'] ?>" 
                   class="btn-success" 
                   onclick="return confirm('Deseja encerrar esta O.S.? Esta ação não pode ser desfeita.')">
                   ✔️ Concluir O.S.
                </a>
            <?php else: ?>
                <span style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: bold;">🔒 O.S. CONCLUÍDA</span>
            <?php endif; ?>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        <div>
            <h4 style="margin-bottom: 15px;">📦 Peças Aplicadas</h4>
            <table>
                <thead>
                    <tr><th>Descrição</th><th>Qtd</th><th>Preço Unit.</th><th>Subtotal</th></tr>
                </thead>
                <tbody>
                    <?php foreach($pecas_usadas as $p): ?>
                    <tr>
                        <td><?= $p['descricao'] ?></td>
                        <td><?= $p['quantidade'] ?></td>
                        <td>R$ <?= number_format($p['preco_unitario'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($p['preco_unitario'] * $p['quantidade'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div>
            <h4 style="margin-bottom: 15px;">⚙️ Mão de Obra</h4>
            <table>
                <thead>
                    <tr><th>Serviço</th><th>Tempo (h)</th><th>Valor</th></tr>
                </thead>
                <tbody>
                    <?php foreach($servicos_feitos as $s): ?>
                    <tr>
                        <td><?= $s['descricao'] ?></td>
                        <td><?= $s['horas_gastas'] ?>h</td>
                        <td>R$ <?= number_format($s['valor_cobrado'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require 'includes/rodape.php'; ?>