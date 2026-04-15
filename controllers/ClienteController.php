<?php
require_once 'models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct($db) {
        $this->clienteModel = new Cliente($db);
    }

    public function consultar() {
        $clientes = $this->clienteModel->consultarClientes();
        // Chama a View passando os dados
        require 'views/cliente/consultar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome'     => $_POST['nome'] ?? '',
                'cpf'      => $_POST['cpf'] ?? '',
                'telefone' => $_POST['telefone'] ?? ''
            ];
            $this->clienteModel->cadastrar($dados);
            header('Location: index.php?controller=cliente&action=consultar');
            exit;
        } else {
            require 'views/cliente/cadastrar.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cliente'];
            $dados = [
                'nome'     => $_POST['nome'] ?? '',
                'cpf'      => $_POST['cpf'] ?? '',
                'telefone' => $_POST['telefone'] ?? ''
            ];
            $this->clienteModel->editar($id, $dados);
            header('Location: index.php?controller=cliente&action=consultar');
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $cliente = $this->clienteModel->consultarClienteID($id);
                if (!$cliente) { echo "Cliente não encontrado."; exit; }
                require 'views/cliente/editar.php';
            } else {
                echo "ID não fornecido."; exit;
            }
        }
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->clienteModel->excluir($id);
                header('Location: index.php?controller=cliente&action=consultar');
                exit;
            } catch (PDOException $e) {
                echo "Erro ao excluir (Pode estar vinculado a um veículo!): " . $e->getMessage();
                echo "<br><a href='index.php?controller=cliente&action=consultar'>Voltar</a>";
            }
        } else {
            echo "ID não fornecido."; exit;
        }
    }
}
?>