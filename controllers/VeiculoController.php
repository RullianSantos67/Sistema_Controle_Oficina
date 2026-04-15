<?php
require_once 'models/Veiculo.php';

class VeiculoController {
    private $model;
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
        $this->model = new Veiculo($conexao);
    }

    public function consultar() {
        $veiculos = $this->model->consultar();
        require 'views/veiculo/consultar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->salvar($_POST);
            header('Location: index.php?controller=veiculo&action=consultar');
        } else {
            $clientes = $this->db->query("SELECT id_cliente, nome FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
            require 'views/veiculo/cadastrar.php';
        }
    }

    public function editar() {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->editar($id, $_POST);
            header('Location: index.php?controller=veiculo&action=consultar');
        } else {
            $veiculo = $this->model->consultarID($id);
            $clientes = $this->db->query("SELECT id_cliente, nome FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
            require 'views/veiculo/editar.php';
        }
    }

    public function excluir() {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?controller=veiculo&action=consultar');
    }
}