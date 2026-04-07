<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bdOficina'; // Agora especificamos o banco

try {
    // Conecta direto no bdOficina
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8mb4", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>