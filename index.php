<?php
session_start();
require_once "config/conexaoBD.php";

$controllerName = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

if (!isset($_SESSION['usuario_id']) && $controllerName != 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit;
}

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
        require 'includes/cabecalho.php';
        echo "
        <div class='cartao card-lg' style='padding: 60px 40px; text-align: center; background: #1e293b; color: white; border-radius: 20px;'>
            <h1 style='font-size: 36px; color: #38bdf8; margin-bottom: 10px;'>⚙️ AutoMecânica Pro</h1>
            <p style='color: #94a3b8; margin-bottom: 30px;'>Gestão de Oficina, Clientes e Estoque em um só lugar.</p>
            <div style='display: flex; gap: 20px; justify-content: center;'>
                <a href='index.php?controller=os&action=consultar' class='btn-concluir'>Ver Oficina</a>
                <a href='index.php?controller=os&action=cadastrar' style='background: #38bdf8; color: #0f172a; padding: 10px 25px; border-radius: 8px; text-decoration: none; font-weight: bold;'>Nova O.S.</a>
            </div>
        </div>";
        require 'includes/rodape.php';
        exit;
    default:
        die("Módulo não encontrado.");
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Erro: Ação não encontrada.";
}