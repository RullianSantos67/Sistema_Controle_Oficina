<?php
// 1. Inicia a sessão (caso já não esteja iniciada no AuthController)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conexão com o Banco de Dados 
require_once 'config/conexaoBD.php';

// 3. Carregando todos os Controllers (O "GPS" precisa conhecer as rotas)
require_once "controllers/AuthController.php";
require_once "controllers/ClienteController.php";
require_once "controllers/VeiculoController.php";
require_once "controllers/PecaController.php";
require_once "controllers/ServicoController.php";
require_once "controllers/MecanicoController.php";
require_once "controllers/OsController.php";
require_once "controllers/UsuarioController.php";
require_once "controllers/SobreController.php";
require_once "controllers/DashboardController.php"; // Nosso novo controlador do painel!

// 4. Capturando o que o usuário quer acessar pela URL
// Se não vier nada na URL, o padrão é ir para o painel (dashboard)
$controllerName = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// 5. O Switch: Apenas escolhe QUAL controlador vai ser ativado
$controller = null;

switch ($controllerName) {
    case 'auth':
        $controller = new AuthController($conexao);
        break;
    case 'cliente':
        $controller = new ClienteController($conexao);
        break;
    case 'veiculo':
        $controller = new VeiculoController($conexao);
        break;
    case 'peca':
        $controller = new PecaController($conexao);
        break;
    case 'servico':
        $controller = new ServicoController($conexao);
        break;
    case 'mecanico':
        $controller = new MecanicoController($conexao);
        break;
    case 'os':
        $controller = new OsController($conexao);
        break;
    case 'usuario':
        $controller = new UsuarioController($conexao);
        break;
    case 'institucional':
        $controller = new SobreController($conexao);
        break;
    case 'dashboard':
        $controller = new DashboardController($conexao);
        break;
    default:
        die("Módulo não encontrado no sistema.");
}

// 6. Executa a Ação (Chama a função dentro do controlador escolhido)
if (isset($controller) && method_exists($controller, $action)) {
    $controller->$action();
} else {
    // Se o arquivo existe, mas a função (ex: consultar, cadastrar) não, ele cai aqui
    echo "Ação não encontrada no controlador.";
}
?>