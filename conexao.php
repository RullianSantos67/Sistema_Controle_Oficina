<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';

try {
    // Conecta apenas no servidor, sem selecionar banco
    $conexao = new PDO("mysql:host=$servidor;charset=utf8mb4", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Não precisa de echo aqui, ele só prepara a conexão para ser usada.
} catch (PDOException $e) {
    echo "Erro na conexão com o servidor: " . $e->getMessage();
}
?>