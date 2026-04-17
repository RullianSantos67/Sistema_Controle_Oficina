<?php require 'includes/cabecalho.php'; ?>

<div class="dashboard-container">
    <div class="dash-banner">
        <div>
            <h1>⚙️ AutoMecânica Pro</h1>
            <p>Bem-vindo(a) de volta, <b><?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin'); ?></b>!</p>
        </div>
        <div class="dash-actions" style="display: flex; gap: 15px;">
            <a href="index.php?controller=os&action=cadastrar" style="background: #16a34a; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">📝 Nova O.S.</a>
            <a href="index.php?controller=cliente&action=cadastrar" style="background: #0284c7; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">👥 Novo Cliente</a>
        </div>
    </div>

    <div class="metric-grid">
        <div class="metric-card border-blue">
            <h4>Clientes Cadastrados</h4>
            <span><?php echo $totalCli; ?></span>
        </div>
        <div class="metric-card border-purple">
            <h4>Veículos na Frota</h4>
            <span><?php echo $totalVei; ?></span>
        </div>
        <div class="metric-card border-orange">
            <h4>O.S. em Andamento</h4>
            <span><?php echo $totalOs; ?></span>
        </div>
        <div class="metric-card border-red">
            <h4>Peças - Estoque Baixo</h4>
            <span><?php echo $pecasBaixas; ?></span>
        </div>
    </div>

    <h3 class="module-title">Acesso aos Módulos</h3>
    <div class="module-grid">
        <a href="index.php?controller=os&action=consultar" class="module-card">
            <div class="module-icon icon-blue">🛠️</div>
            <div><h4>Gestão de O.S.</h4><span>Visualizar Ordens de Serviço</span></div>
        </a>
        <a href="index.php?controller=veiculo&action=consultar" class="module-card">
            <div class="module-icon icon-purple">🚗</div>
            <div><h4>Frota</h4><span>Gerenciar Carros</span></div>
        </a>
        <a href="index.php?controller=peca&action=consultar" class="module-card">
            <div class="module-icon icon-orange">📦</div>
            <div><h4>Estoque</h4><span>Inventário de Peças</span></div>
        </a>
        <a href="index.php?controller=mecanico&action=consultar" class="module-card">
            <div class="module-icon icon-green">👨‍🔧</div>
            <div><h4>Equipe</h4><span>Mecânicos da Oficina</span></div>
        </a>
    </div>
</div>

<?php require 'includes/rodape.php'; ?>