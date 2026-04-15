<?php
class Mecanico {
    private $conexao;
    public function __construct($db) { $this->conexao = $db; }

    public function consultarMecanicos() {
        return $this->conexao->query("SELECT * FROM mecanico ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function consultarMecanicoID($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM mecanico WHERE id_mecanico = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function cadastrar($dados) {
        $stmt = $this->conexao->prepare("INSERT INTO mecanico (nome, especialidade) VALUES (:nome, :especialidade)");
        return $stmt->execute($dados);
    }
    public function editar($dados) {
        $stmt = $this->conexao->prepare("UPDATE mecanico SET nome = :nome, especialidade = :especialidade WHERE id_mecanico = :id_mecanico");
        return $stmt->execute($dados);
    }
    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM mecanico WHERE id_mecanico = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>