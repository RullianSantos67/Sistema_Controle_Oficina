<?php
require_once 'models/Mecanico.php';

class MecanicoController {
    private $mecanicoModel;
    public function __construct($db) { $this->mecanicoModel = new Mecanico($db); }

    public function consultar() {
        $mecanicos = $this->mecanicoModel->consultarMecanicos();
        require 'views/mecanico/consultar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [':nome' => $_POST['nome'], ':especialidade' => $_POST['especialidade']];
            $this->mecanicoModel->cadastrar($dados);
            header('Location: index.php?controller=mecanico&action=consultar');
        } else {
            require 'views/mecanico/cadastrar.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [':nome' => $_POST['nome'], ':especialidade' => $_POST['especialidade'], ':id_mecanico' => $_POST['id_mecanico']];
            $this->mecanicoModel->editar($dados);
            header('Location: index.php?controller=mecanico&action=consultar');
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $mecanico = $this->mecanicoModel->consultarMecanicoID($id);
                require 'views/mecanico/editar.php';
            }
        }
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->mecanicoModel->excluir($id);
            header('Location: index.php?controller=mecanico&action=consultar');
        }
    }
}
?>