# AutoMecânica Pro — Sistema de Controle de Oficina

Desenvolvido por Rullian Santos e Carlos Eduardo.

## Sobre o Projeto

Sistema web de gestão integrada para oficinas mecânicas, desenvolvido em PHP com banco de dados MySQL.  
Permite o cadastro, consulta e gerenciamento de clientes, veículos, ordens de serviço, peças e mecânicos.

## Funcionalidades

- **Clientes** — Cadastro, listagem, edição e exclusão de clientes (com validação de CPF e telefone)
- **Veículos** — Registro de veículos vinculados aos seus respectivos proprietários
- **Ordens de Serviço** — Abertura, acompanhamento e conclusão de O.S.
- **Estoque de Peças** — Controle de inventário
- **Equipe de Mecânicos** — Gerenciamento da equipe
- **Serviços** — Tabela de serviços com valor por hora
- **Painel (Dashboard)** — Visão geral com métricas em tempo real

## Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior (ou MariaDB equivalente)
- Servidor web (Apache, Nginx ou PHP built-in server)

## Configuração e Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/RullianSantos67/Sistema_Controle_Oficina.git
cd Sistema_Controle_Oficina
```

### 2. Configure a conexão com o banco de dados

Edite os arquivos em `config/` com os dados do seu servidor MySQL:

- `config/conexao.php` — Conexão sem banco (usada apenas para criar o banco)
- `config/conexaoBD.php` — Conexão com o banco `bdOficina`

```php
$servidor = 'localhost';
$usuario  = 'root';
$senha    = '';       // Altere para a senha do seu MySQL
```

### 3. Crie o banco de dados e as tabelas

**Opção A — Via script SQL (recomendado):**

```bash
mysql -u root -p < database/schema.sql
```

**Opção B — Via PHP (navegador):**

Acesse em sequência pelo navegador (com o servidor web rodando):

1. `http://localhost/database/criarBD.php` — Cria o banco `bdOficina`
2. `http://localhost/database/criarTabelas.php` — Cria todas as tabelas
3. `http://localhost/database/criarTabelaUsuario.php` — Cria a tabela de usuários e o Admin padrão

### 4. Inicie o servidor

```bash
# Usando o servidor embutido do PHP (desenvolvimento)
php -S localhost:8000
```

### 5. Acesse o sistema

Abra `http://localhost:8000` no navegador.

**Credenciais padrão:**
- **E-mail:** `admin@oficina.com`
- **Senha:** `123456`

## Estrutura do Projeto

```
Sistema_Controle_Oficina/
├── config/          # Arquivos de conexão com o banco de dados
├── controllers/     # Controladores MVC (lógica de negócio)
├── database/        # Scripts de criação do banco e schema SQL
├── includes/        # Cabeçalho e rodapé compartilhados
├── models/          # Modelos MVC (acesso ao banco de dados)
├── views/           # Views MVC (interface do usuário)
└── index.php        # Ponto de entrada (front controller)
```
