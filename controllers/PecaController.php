<?php
require_once 'models/Peca.php';

class PecaController {
    private $pecaModel;
    public function __construct($db) { $this->pecaModel = new Peca($db); }

    public function consultar() {
        $pecas = $this->pecaModel->consultarPecas();
        require 'views/peca/consultar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':descricao' => $_POST['descricao'],
                ':preco_base' => $_POST['preco_base'],
                ':quantidade_estoque' => $_POST['quantidade']
            ];
            $this->pecaModel->cadastrar($dados);
            header('Location: index.php?controller=peca&action=consultar');
            exit;
        } else {
            require 'views/peca/cadastrar.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':descricao' => $_POST['descricao'],
                ':preco_base' => $_POST['preco_base'],
                ':quantidade_estoque' => $_POST['quantidade'],
                ':id_peca' => $_POST['id_peca']
            ];
            $this->pecaModel->editar($dados);
            header('Location: index.php?controller=peca&action=consultar');
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $peca = $this->pecaModel->consultarPecaID($id);
                require 'views/peca/editar.php';
            }
        }
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->pecaModel->excluir($id);
            header('Location: index.php?controller=peca&action=consultar');
        }
    }
}
?>