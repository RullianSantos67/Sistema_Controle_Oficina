<?php
class UsuarioController {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    public function consultar() {
        $usuarios = $this->db->query("SELECT * FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
        require_once "views/usuario/consultar.php";
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $perfil = $_POST['nivel'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO usuario (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $senha, $perfil]);

            header("Location: index.php?controller=usuario&action=consultar");
            exit;
        }
        require_once "views/usuario/cadastrar.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_usuario'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $perfil = $_POST['nivel'];

            // Só atualiza a senha se o campo não estiver vazio
            if (!empty($_POST['senha'])) {
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $stmt = $this->db->prepare("UPDATE usuario SET nome=?, email=?, senha=?, perfil=? WHERE id_usuario=?");
                $stmt->execute([$nome, $email, $senha, $perfil, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE usuario SET nome=?, email=?, perfil=? WHERE id_usuario=?");
                $stmt->execute([$nome, $email, $perfil, $id]);
            }

            header("Location: index.php?controller=usuario&action=consultar");
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        require_once "views/usuario/editar.php";
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $this->db->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            $stmt->execute([$id]);
        }
        header("Location: index.php?controller=usuario&action=consultar");
        exit;
    }
}