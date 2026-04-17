<?php
require_once 'models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct($db) {
        $this->clienteModel = new Cliente($db);
    }

    public function consultar() {
        $clientes = $this->clienteModel->consultarclientes();
        require 'views/cliente/consultar.php';
    }

    // Validação de CPF (Algoritmo oficial)
    private function validarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) return false;
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }

    // --- NOVA VALIDAÇÃO DE TELEFONE ---
    private function validarTelefone($tel) {
        // Remove tudo que não for número
        $tel = preg_replace('/[^0-9]/', '', $tel);
        // Verifica se tem entre 10 e 11 dígitos (DDD + número)
        return (strlen($tel) >= 11 && strlen($tel) <= 12);
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cpf = $_POST['cpf'] ?? '';
            $telefone = $_POST['telefone'] ?? '';

            // 1. Valida CPF
            if (!$this->validarCPF($cpf)) {
                echo "<script>alert('Erro: CPF informado é inválido!'); history.back();</script>";
                exit;
            }

            // 2. Valida Telefone
            if (!$this->validarTelefone($telefone)) {
                echo "<script>alert('Erro: Informe um telefone válido com DDD (ex: 35988776655)!'); history.back();</script>";
                exit;
            }

            try {
                $dados = [
                    'nome'     => $_POST['nome'] ?? '',
                    'cpf'      => $cpf,
                    'telefone' => $telefone
                ];
                $this->clienteModel->cadastrar($dados);
                header('Location: index.php?controller=cliente&action=consultar');
                exit;
            } catch (PDOException $e) {
                // Trata o erro de CPF duplicado sem travar o sistema
                if ($e->getCode() == 23000) {
                    echo "<script>alert('Erro: Este CPF já está cadastrado para outro cliente!'); history.back();</script>";
                } else {
                    echo "Erro inesperado: " . $e->getMessage();
                }
                exit;
            }
        } else {
            require 'views/cliente/cadastrar.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cliente'];
            $cpf = $_POST['cpf'] ?? '';
            $telefone = $_POST['telefone'] ?? '';

            if (!$this->validarCPF($cpf)) {
                echo "<script>alert('Erro: CPF inválido!'); history.back();</script>";
                exit;
            }

            if (!$this->validarTelefone($telefone)) {
                echo "<script>alert('Erro: Telefone inválido!'); history.back();</script>";
                exit;
            }

            try {
                $dados = [
                    'nome'     => $_POST['nome'] ?? '',
                    'cpf'      => $cpf,
                    'telefone' => $telefone
                ];
                $this->clienteModel->editar($id, $dados);
                header('Location: index.php?controller=cliente&action=consultar');
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo "<script>alert('Erro: Este CPF já pertence a outro cliente!'); history.back();</script>";
                } else {
                    echo "Erro ao atualizar: " . $e->getMessage();
                }
                exit;
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $cliente = $this->clienteModel->consultarClienteID($id);
                require 'views/cliente/editar.php';
            }
        }
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->clienteModel->excluir($id);
            header('Location: index.php?controller=cliente&action=consultar');
        }
    }
}