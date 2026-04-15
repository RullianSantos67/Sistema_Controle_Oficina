<?php
class AuthController {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['usuario_id'] = $user['id_usuario'];
                $_SESSION['usuario_nome'] = $user['nome'];
                header('Location: index.php?controller=dashboard');
                exit;
            }
            $erro = "Credenciais inválidas!";
        }
        require 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}