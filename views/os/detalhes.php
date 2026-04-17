<?php require 'includes/cabecalho.php'; ?>

<div class="cartao">
    <h3>🛠️ Detalhes da Ordem de Serviço #<?= str_pad($os['id_os'], 4, '0', STR_PAD_LEFT) ?></h3>
    
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
        <span style="font-size: 20px; font-weight: 800; color: #16a34a;">Total: R$ <?= number_format($os['valor_total'], 2, ',', '.') ?></span>
        
        <?php if($os['status'] != 'Concluída'): ?>
            <a href="index.php?controller=os&action=editar&id=<?= $os['id_os'] ?>" 
   style="background-color: #f59e0b !important; color: white !important; padding: 10px 20px !important; border-radius: 8px !important; font-size: 14px !important; text-decoration: none !important; font-weight: 600 !important; display: inline-block !important; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: 0.2s;">
   ✏️ Editar O.S.
</a>
            
            <a href="index.php?controller=os&action=concluir&id=<?= $os['id_os'] ?>" 
               class="btn-success" 
               onclick="return confirm('Deseja encerrar esta O.S.? Esta ação não pode ser desfeita.')">
               ✔️ Concluir O.S.
            </a>
        <?php else: ?>
            <span style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: bold;">🔒 O.S. CONCLUÍDA E BLOQUEADA</span>
        <?php endif; ?>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h4 style="color: #334155; display: flex; align-items: center; gap: 8px;">📦 Peças Aplicadas</h4>
                </div>
            <table>
                <thead>
                    <tr><th>Descrição</th><th>Qtd</th><th>Preço Unit.</th><th>Subtotal</th></tr>
                </thead>
                <tbody>
                    <?php if(!empty($pecas_usadas)): ?>
                        <?php foreach($pecas_usadas as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['descricao']) ?></td>
                            <td><?= $p['quantidade'] ?></td>
                            <td>R$ <?= number_format($p['preco_unitario'], 2, ',', '.') ?></td>
                            <td style="font-weight: 600;">R$ <?= number_format($p['preco_unitario'] * $p['quantidade'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align: center; color: #94a3b8;">Nenhuma peça lançada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h4 style="color: #334155; display: flex; align-items: center; gap: 8px;">⚙️ Mão de Obra</h4>
                </div>
            <table>
                <thead>
                    <tr><th>Serviço</th><th>Tempo (h)</th><th>Valor</th></tr>
                </thead>
                <tbody>
                    <?php if(!empty($servicos_feitos)): ?>
                        <?php foreach($servicos_feitos as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['descricao']) ?></td>
                            <td><?= number_format($s['horas_gastas'], 2, ',', '.') ?>h</td>
                            <td style="font-weight: 600;">R$ <?= number_format($s['valor_cobrado'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" style="text-align: center; color: #94a3b8;">Nenhum serviço lançado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require 'includes/rodape.php'; ?>