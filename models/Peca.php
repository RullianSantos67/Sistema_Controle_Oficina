<?php
class Peca {
    private $conexao;
    public function __construct($db) { $this->conexao = $db; }

    public function consultarPecas() {
        return $this->conexao->query("SELECT * FROM peca ORDER BY descricao ASC")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function consultarPecaID($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM peca WHERE id_peca = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function cadastrar($dados) {
        $stmt = $this->conexao->prepare("INSERT INTO peca (descricao, preco_base, quantidade_estoque) VALUES (:descricao, :preco_base, :quantidade_estoque)");
        return $stmt->execute($dados);
    }
    public function editar($dados) {
        $stmt = $this->conexao->prepare("UPDATE peca SET descricao = :descricao, preco_base = :preco_base, quantidade_estoque = :quantidade_estoque WHERE id_peca = :id_peca");
        return $stmt->execute($dados);
    }
    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM peca WHERE id_peca = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>