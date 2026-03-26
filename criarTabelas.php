<?php
// Puxa a conexão específica do banco de dados
require 'conexaoBD.php';

try {
    // Tabelas Independentes
    $conexao->exec("
        CREATE TABLE IF NOT EXISTS cliente (
            id_cliente INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            telefone VARCHAR(20),
            cpf VARCHAR(15) UNIQUE NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS mecanico (
            id_mecanico INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            especialidade VARCHAR(50)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS peca (
            id_peca INT AUTO_INCREMENT PRIMARY KEY,
            descricao VARCHAR(150) NOT NULL,
            preco_base DECIMAL(10,2) NOT NULL,
            quantidade_estoque INT DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS servico (
            id_servico INT AUTO_INCREMENT PRIMARY KEY,
            descricao VARCHAR(150) NOT NULL,
            valor_hora DECIMAL(10,2) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Tabelas Dependentes (Chaves Estrangeiras)
    $conexao->exec("
        CREATE TABLE IF NOT EXISTS veiculo (
            id_veiculo INT AUTO_INCREMENT PRIMARY KEY,
            placa VARCHAR(10) UNIQUE NOT NULL,
            marca VARCHAR(50),
            modelo VARCHAR(50),
            ano INT,
            id_cliente INT NOT NULL,
            CONSTRAINT fk_veiculo_cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS ordem_servico (
            id_os INT AUTO_INCREMENT PRIMARY KEY,
            data_entrada DATE NOT NULL,
            data_previsao DATE,
            status VARCHAR(30) DEFAULT 'Aberta',
            valor_total DECIMAL(10,2) DEFAULT 0.00,
            id_veiculo INT NOT NULL,
            id_mecanico INT NOT NULL,
            CONSTRAINT fk_os_veiculo FOREIGN KEY (id_veiculo) REFERENCES veiculo(id_veiculo) ON DELETE CASCADE,
            CONSTRAINT fk_os_mecanico FOREIGN KEY (id_mecanico) REFERENCES mecanico(id_mecanico) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS os_peca (
            id_os INT NOT NULL,
            id_peca INT NOT NULL,
            quantidade INT NOT NULL,
            preco_unitario DECIMAL(10,2) NOT NULL,
            PRIMARY KEY (id_os, id_peca),
            CONSTRAINT fk_ospeca_os FOREIGN KEY (id_os) REFERENCES ordem_servico(id_os) ON DELETE CASCADE,
            CONSTRAINT fk_ospeca_peca FOREIGN KEY (id_peca) REFERENCES peca(id_peca) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS os_servico (
            id_os INT NOT NULL,
            id_servico INT NOT NULL,
            horas_gastas DECIMAL(5,2) NOT NULL,
            valor_cobrado DECIMAL(10,2) NOT NULL,
            PRIMARY KEY (id_os, id_servico),
            CONSTRAINT fk_osservico_os FOREIGN KEY (id_os) REFERENCES ordem_servico(id_os) ON DELETE CASCADE,
            CONSTRAINT fk_osservico_servico FOREIGN KEY (id_servico) REFERENCES servico(id_servico) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    echo "Todas as tabelas foram criadas com sucesso!";

} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}
?>