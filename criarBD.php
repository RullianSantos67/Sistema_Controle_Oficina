<?php
// Puxa o arquivo de conexão geral
require 'conexao.php';

try {
    $sql = "CREATE DATABASE IF NOT EXISTS bdOficina";
    $conexao->exec($sql);
    echo "Banco de dados 'bdOficina' criado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar o banco de dados: " . $e->getMessage();
}
?>