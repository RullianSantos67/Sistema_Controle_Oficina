<?php
$pagina = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMecânica Pro - Gestão de Oficina</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            color: #333; 
            background: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.85);
            z-index: -1;
        }

        /* Navbar Superior */
        .topbar { 
            width: 100%; 
            background-color: rgba(15, 23, 42, 0.98); 
            padding: 0 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            backdrop-filter: blur(15px); 
            box-shadow: 0 4px 20px rgba(0,0,0,0.6); 
            z-index: 100; 
            position: sticky; 
            top: 0;
            height: 70px;
        }

        .topbar .logo { 
            font-size: 22px; 
            color: #38bdf8; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-nav { display: flex; height: 100%; }

        .menu-item { position: relative; display: flex; align-items: center; height: 100%; }

        .menu-link { 
            color: #cbd5e1; text-decoration: none; padding: 0 15px; height: 100%; display: flex; 
            align-items: center; gap: 8px; font-weight: 500; font-size: 14px; transition: 0.3s; cursor: pointer;
        }

        .menu-link:hover, .menu-item.active > .menu-link { 
            color: #38bdf8; background: rgba(255,255,255,0.05);
        }

        /* Dropdown (Menu que Cai) */
        .dropdown {
            position: absolute; top: 70px; left: 0; background-color: #1e293b; min-width: 220px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.4); border-radius: 0 0 8px 8px; display: none;
            flex-direction: column; overflow: hidden; border-top: 2px solid #38bdf8;
        }

        .dropdown a { color: #cbd5e1; padding: 12px 20px; text-decoration: none; display: block; font-size: 13px; transition: 0.3s; }
        .dropdown a:hover { background-color: #334155; color: white; padding-left: 25px; }
        .menu-item:hover .dropdown { display: flex; }

        /* Conteúdo e Cartões */
        .conteudo { flex: 1; padding: 40px; display: flex; flex-direction: column; align-items: center; z-index: 1; }
        .cartao { background: rgba(255, 255, 255, 0.98); width: 100%; max-width: 1000px; padding: 35px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); margin-bottom: 25px; text-align: left; }
        .cartao h3 { margin-bottom: 25px; color: #0f172a; font-size: 24px; border-bottom: 4px solid #38bdf8; padding-bottom: 8px; display: inline-block;}
        
        /* Formulários */
        .grupo-input { margin-bottom: 20px; width: 100%; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #334155; font-size: 14px; }
        input[type="text"], input[type="number"], input[type="date"], select { width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: 0.3s; font-size: 15px; background-color: #f8fafc; }
        input:focus, select:focus { border-color: #38bdf8; background-color: #fff; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2); }
        
        /* Botões */
        .btn { display: inline-block; width: 100%; padding: 14px; background-color: #0284c7; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; text-align: center; text-decoration: none; transition: 0.3s; margin-top: 10px; }
        .btn:hover { background-color: #0369a1; transform: translateY(-2px); }
        
        /* Tabelas */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; margin-top: 15px;}
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px;}
        th { background-color: #0f172a; color: white; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;}

        /* Alertas */
        .alerta { padding: 15px; margin-bottom: 20px; border-radius: 8px; text-align: center; font-weight: 600; font-size: 14px; }
        .sucesso { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .erro { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Cards Painel */
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; width: 100%; max-width: 1000px; margin-bottom: 35px; }
        .card-dash { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center; position: relative; overflow: hidden; }
        .card-dash::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 5px; background: #38bdf8; }
        .card-dash h4 { font-size: 14px; color: #64748b; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;}
        .card-dash h1 { font-size: 45px; color: #0f172a; font-weight: 700; }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="topbar">
        <a href="index.php" class="logo">⚙️ AutoMecânica</a>
        
        <nav class="topbar-nav">
            <div class="menu-item <?= $pagina == 'index.php' ? 'active' : '' ?>">
                <a href="index.php" class="menu-link">📊 Painel</a>
            </div>

            <div class="menu-item <?= ($pagina == 'listar_clientes.php' || $pagina == 'cadastrar_cliente.php') ? 'active' : '' ?>">
                <div class="menu-link">👥 Clientes ▾</div>
                <div class="dropdown">
                    <a href="listar_clientes.php">Listar Todos</a>
                    <a href="cadastrar_cliente.php">➕ Novo Cadastro</a>
                </div>
            </div>

            <div class="menu-item <?= ($pagina == 'listar_veiculos.php' || $pagina == 'cadastrar_veiculo.php') ? 'active' : '' ?>">
                <div class="menu-link">🚗 Veículos ▾</div>
                <div class="dropdown">
                    <a href="listar_veiculos.php">Listar Frota</a>
                    <a href="cadastrar_veiculo.php">➕ Novo Veículo</a>
                </div>
            </div>

            <div class="menu-item <?= ($pagina == 'listar_pecas.php' || $pagina == 'cadastrar_peca.php') ? 'active' : '' ?>">
                <div class="menu-link">📦 Estoque ▾</div>
                <div class="dropdown">
                    <a href="listar_pecas.php">Ver Peças</a>
                    <a href="cadastrar_peca.php">➕ Adicionar Peça</a>
                </div>
            </div>

            <div class="menu-item <?= ($pagina == 'listar_os.php' || $pagina == 'cadastrar_os.php' || $pagina == 'detalhes_os.php') ? 'active' : '' ?>">
                <div class="menu-link">🛠️ Oficina ▾</div>
                <div class="dropdown">
                    <a href="listar_os.php">Ordens de Serviço</a>
                    <a href="cadastrar_os.php">📝 Abrir Nova O.S.</a>
                    <hr style="border-color: #334155; margin: 5px 0;">
                    <a href="cadastrar_servico.php">Tabela de Mão de Obra</a>
                    <a href="cadastrar_mecanico.php">Registar Mecânico</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="conteudo">