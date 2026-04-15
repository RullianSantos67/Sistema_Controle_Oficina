<?php
class Servico {
    private $conexao;
    public function __construct($db) { $this->conexao = $db; }

    public function consultarServicos() {
        return $this->conexao->query("SELECT * FROM servico ORDER BY descricao ASC")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function consultarServicoID($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM servico WHERE id_servico = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function cadastrar($dados) {
        $stmt = $this->conexao->prepare("INSERT INTO servico (descricao, valor_hora) VALUES (:descricao, :valor_hora)");
        return $stmt->execute($dados);
    }
    public function editar($dados) {
        $stmt = $this->conexao->prepare("UPDATE servico SET descricao = :descricao, valor_hora = :valor_hora WHERE id_servico = :id_servico");
        return $stmt->execute($dados);
    }
    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM servico WHERE id_servico = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>