<?php
session_start();
require_once "config/conexaoBD.php";

$controllerName = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// Proteção de Login
if (!isset($_SESSION['usuario_id']) && $controllerName != 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit;
}

// Carregando Controllers
require_once "controllers/AuthController.php";
require_once "controllers/ClienteController.php";
require_once "controllers/VeiculoController.php"; 
require_once "controllers/PecaController.php";
require_once "controllers/ServicoController.php";
require_once "controllers/MecanicoController.php";
require_once "controllers/OsController.php";

switch ($controllerName) {
    case 'auth':     $controller = new AuthController($conexao); break;
    case 'cliente':  $controller = new ClienteController($conexao); break;
    case 'veiculo':  $controller = new VeiculoController($conexao); break;
    case 'peca':     $controller = new PecaController($conexao); break;
    case 'servico':  $controller = new ServicoController($conexao); break;
    case 'mecanico': $controller = new MecanicoController($conexao); break;
    case 'os':       $controller = new OsController($conexao); break;
    
    case 'dashboard':
        // AQUI CARREGA O CABEÇALHO E O CSS
        require 'includes/cabecalho.php';
        
        $totalCli = 0; $totalVei = 0; $totalOs = 0; $pecasBaixas = 0;
        try {
            $totalCli = $conexao->query("SELECT COUNT(*) FROM cliente")->fetchColumn() ?: 0;
            $totalVei = $conexao->query("SELECT COUNT(*) FROM veiculo")->fetchColumn() ?: 0;
            $totalOs  = $conexao->query("SELECT COUNT(*) FROM ordem_servico WHERE status != 'Concluída'")->fetchColumn() ?: 0;
            $pecasBaixas = $conexao->query("SELECT COUNT(*) FROM peca WHERE quantidade_estoque <= 3")->fetchColumn() ?: 0;
        } catch (Exception $e) {} 
        ?>

        <div class="dashboard-container">
            <div class="dash-banner">
                <div>
                    <h1>⚙️ AutoMecânica Pro</h1>
                    <p>Bem-vindo(a) de volta, <b><?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin'); ?></b>!</p>
                </div>
               <div class="dash-actions" style="display: flex; gap: 15px;">
                    <a href="index.php?controller=os&action=cadastrar" style="background: #16a34a; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: 0.3s;">📝 Nova O.S.</a>
                    
                    <a href="index.php?controller=cliente&action=cadastrar" style="background: #0284c7; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: 0.3s;">👥 Novo Cliente</a>
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
        <?php
        require 'includes/rodape.php';
        exit;
    default:
        die("Módulo não encontrado.");
}

// Executa a Ação
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Ação não encontrada no controlador.";
}
?>