<?php 
        require 'config/conexaoBD.php';

// Contagens para o painel
$totalClientes = $conexao->query("SELECT COUNT(*) FROM cliente")->fetchColumn();
$totalVeiculos = $conexao->query("SELECT COUNT(*) FROM veiculo")->fetchColumn();
$totalOS = $conexao->query("SELECT COUNT(*) FROM ordem_servico WHERE status = 'Aberta' OR status = 'Em Andamento'")->fetchColumn();

            require 'includes/cabecalho.php'; 
?>

<div class="dashboard-grid">
    <div class="card-dash">
        <h4>👥 Clientes Cadastrados</h4>
        <h1><?= $totalClientes ?></h1>
    </div>
    <div class="card-dash">
        <h4>🚗 Veículos na Base</h4>
        <h1><?= $totalVeiculos ?></h1>
    </div>
    <div class="card-dash" style="border-bottom-color: #f59e0b;">
        <h4>🛠️ O.S. Abertas</h4>
        <h1 style="color: #d97706;"><?= $totalOS ?></h1>
    </div>
</div>

<div class="cartao">
    <h3>Visão Geral do Sistema</h3>
    <p style="color: #475569; line-height: 1.6; margin-bottom: 20px;">
        Bem-vindo ao painel de controle. Aqui você tem um resumo rápido da operação da oficina. 
        Utilize o menu lateral para gerenciar os cadastros e abrir novas Ordens de Serviço.
    </p>
    <div style="display: flex; gap: 20px;">
        <a href="cadastrar_os.php" class="btn" style="background-color: #10b981; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);">📝 Iniciar Nova O.S.</a>
        <a href="cadastrar_cliente.php" class="btn">➕ Cadastrar Cliente</a>
    </div>
</div>

<?php require 'includes/rodape.php'; ?>