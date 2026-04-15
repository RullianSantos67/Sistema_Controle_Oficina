<?php
class Cliente {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function consultarClientes() {
        $stmt = $this->conexao->query("SELECT * FROM cliente ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarClienteID($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($dados) {
        $sql = "INSERT INTO cliente (nome, cpf, telefone) VALUES (:nome, :cpf, :telefone)";
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute([
            ':nome'     => $dados['nome'],
            ':cpf'      => $dados['cpf'],
            ':telefone' => $dados['telefone']
        ]);
    }

    public function editar($id, $dados) {
        $sql = "UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone WHERE id_cliente = :id";
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute([
            ':nome'     => $dados['nome'],
            ':cpf'      => $dados['cpf'],
            ':telefone' => $dados['telefone'],
            ':id'       => $id
        ]);
    }

    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM cliente WHERE id_cliente = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>