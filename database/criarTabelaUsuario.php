<?php
// database/criarTabelaUsuario.php
require '../config/conexaoBD.php';

try {
    // 1. Cria a tabela de usuários
    $sql = "CREATE TABLE IF NOT EXISTS usuario (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        perfil ENUM('Admin', 'Atendente', 'Mecanico') NOT NULL
    )";
    $conexao->exec($sql);

    // 2. Cria o primeiro Admin com a senha "123456" criptografada
    $senha_criptografada = password_hash('123456', PASSWORD_DEFAULT); 
    
    // Verifica se já existe para não duplicar
    $check = $conexao->query("SELECT * FROM usuario WHERE email = 'admin@oficina.com'")->fetch();
    
    if(!$check) {
        $insert = "INSERT INTO usuario (nome, email, senha, perfil) VALUES ('Rullian Admin', 'admin@oficina.com', '$senha_criptografada', 'Admin')";
        $conexao->exec($insert);
        echo "<h3 style='color: green;'>✅ Tabela criada e Admin gerado com sucesso!</h3>";
        echo "<p>Email: admin@oficina.com | Senha: 123456</p>";
    } else {
        echo "<h3 style='color: orange;'>⚠️ O Admin já existe no banco.</h3>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>