<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-lg">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 style="margin: 0;">👥 Gerenciamento de Usuários</h3>
        <a href="index.php?controller=usuario&action=cadastrar" class="btn btn-blue" style="text-decoration: none;">
            + Novo Usuário
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Usuário</th>
                <th>E-mail (Login)</th>
                <th>Perfil / Nível</th>
                <th style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td style="font-weight: bold; color: #64748b;">
                            #<?= str_pad($u['id_usuario'], 3, '0', STR_PAD_LEFT) ?>
                        </td>
                        <td><?= htmlspecialchars($u['nome']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td>
                            <?php 
                                // Estilo dinâmico para o selo de nível
                                $corFundo = (strtolower($u['perfil']) == 'admin') ? '#dcfce7' : '#f1f5f9';
                                $corTexto = (strtolower($u['perfil']) == 'admin') ? '#166534' : '#475569';
                            ?>
                            <span style="padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; background: <?= $corFundo ?>; color: <?= $corTexto ?>; border: 1px solid rgba(0,0,0,0.05);">
                                <?= strtoupper($u['perfil']) ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="index.php?controller=usuario&action=editar&id=<?= $u['id_usuario'] ?>" 
                               class="btn-acao-editar" 
                               title="Editar Usuário">
                               Editar
                            </a>

                            <a href="index.php?controller=usuario&action=excluir&id=<?= $u['id_usuario'] ?>" 
                               style="color: #ef4444; font-size: 12px; font-weight: 600; text-decoration: none; margin-left: 15px;" 
                               onclick="return confirm('⚠️ ATENÇÃO: Tem certeza que deseja excluir o usuário <?= $u['nome'] ?>? Esta ação não pode ser desfeita.')">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <p>Nenhum usuário encontrado no sistema.</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require 'includes/rodape.php'; ?>