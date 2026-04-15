<?php
class Veiculo {
    private $db;
    public function __construct($conexao) { $this->db = $conexao; }

    public function consultar() {
        return $this->db->query("SELECT v.*, c.nome as dono FROM veiculo v JOIN cliente c ON v.id_cliente = c.id_cliente")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarID($id) {
        $stmt = $this->db->prepare("SELECT * FROM veiculo WHERE id_veiculo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO veiculo (placa, marca, modelo, ano, id_cliente) VALUES (?, ?, ?, ?, ?)";
        return $this->db->prepare($sql)->execute([$dados['placa'], $dados['marca'], $dados['modelo'], $dados['ano'], $dados['id_cliente']]);
    }

    public function editar($id, $dados) {
        $sql = "UPDATE veiculo SET placa=?, marca=?, modelo=?, ano=?, id_cliente=? WHERE id_veiculo=?";
        return $this->db->prepare($sql)->execute([$dados['placa'], $dados['marca'], $dados['modelo'], $dados['ano'], $dados['id_cliente'], $id]);
    }

    public function excluir($id) {
        return $this->db->prepare("DELETE FROM veiculo WHERE id_veiculo = ?")->execute([$id]);
    }
}