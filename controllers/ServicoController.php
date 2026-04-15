<?php
require_once 'models/Servico.php';

class ServicoController {
    private $servicoModel;
    public function __construct($db) { $this->servicoModel = new Servico($db); }

    public function consultar() {
        $servicos = $this->servicoModel->consultarServicos();
        require 'views/servico/consultar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [':descricao' => $_POST['descricao'], ':valor_hora' => $_POST['valor_hora']];
            $this->servicoModel->cadastrar($dados);
            header('Location: index.php?controller=servico&action=consultar');
        } else {
            require 'views/servico/cadastrar.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [':descricao' => $_POST['descricao'], ':valor_hora' => $_POST['valor_hora'], ':id_servico' => $_POST['id_servico']];
            $this->servicoModel->editar($dados);
            header('Location: index.php?controller=servico&action=consultar');
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $servico = $this->servicoModel->consultarServicoID($id);
                require 'views/servico/editar.php';
            }
        }
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->servicoModel->excluir($id);
            header('Location: index.php?controller=servico&action=consultar');
        }
    }
}
?>