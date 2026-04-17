<?php
// Identifica qual o controller atual para destacar o menu ativo
$controllerAtual = $_GET['controller'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMecânica Pro - Gestão Integrada</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        /* =========================================
           1. CONFIGURAÇÕES GLOBAIS E RESET
        ========================================= */
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: 'Poppins', sans-serif; 
        }
        
        body { 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            color: #334155; 
            background: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed; 
            background-size: cover; 
        }
        
        /* Overlay para escurecer o fundo nas páginas internas */
        .overlay { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(15, 23, 42, 0.85); 
            z-index: -1; 
        }

        /* =========================================
           2. BARRA DE NAVEGAÇÃO (TOPBAR)
        ========================================= */
        .topbar { 
            background-color: #1e293b; 
            height: 70px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 0 40px; 
            border-bottom: 2px solid #38bdf8; 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.6); 
        }
        
        .logo { 
            color: #38bdf8; 
            font-weight: 800; 
            text-decoration: none; 
            font-size: 22px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        
        .topbar-nav { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
            height: 100%; 
        }
        
        .menu-item { 
            position: relative; 
            display: flex; 
            align-items: center; 
            height: 100%; 
        }
        
        .menu-link { 
            color: #cbd5e1; 
            text-decoration: none; 
            font-weight: 500; 
            font-size: 14px; 
            padding: 10px 15px; 
            border-radius: 6px; 
            transition: 0.3s; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            gap: 8px;
        }
        
        .menu-link:hover, .menu-item.active .menu-link { 
            color: #38bdf8; 
            background: rgba(255,255,255,0.05); 
        }
        
        /* Dropdown Menu */
        .dropdown { 
            position: absolute; 
            top: 70px; 
            left: 0; 
            background-color: #1e293b; 
            min-width: 220px; 
            display: none; 
            flex-direction: column; 
            box-shadow: 0 10px 15px rgba(0,0,0,0.3); 
            border-radius: 0 0 8px 8px; 
            overflow: hidden; 
            border-top: 2px solid #38bdf8; 
        }
        
        .menu-item:hover .dropdown { 
            display: flex; 
        }
        
        .dropdown a { 
            color: #cbd5e1; 
            padding: 12px 20px; 
            text-decoration: none; 
            font-size: 13px; 
            border-bottom: 1px solid #334155; 
            transition: 0.3s; 
        }
        
        .dropdown a:hover { 
            background-color: #334155; 
            color: white; 
            padding-left: 25px; 
        }

        /* =========================================
           3. ESTRUTURA DE CONTEÚDO E CARDS
        ========================================= */
        .conteudo { 
            padding: 40px; 
            flex: 1; 
            display: flex; 
            justify-content: center; 
            align-items: flex-start; 
            z-index: 1; 
        }
        
        .cartao { 
            background-color: rgba(255, 255, 255, 0.98); 
            width: 100%; 
            padding: 35px; 
            border-radius: 16px; 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); 
            margin-bottom: 25px; 
        }
        
        .card-lg { max-width: 1100px; }
        .card-sm { max-width: 600px; }
        
        .cartao h3 { 
            margin-bottom: 25px; 
            color: #0f172a; 
            font-size: 24px; 
            border-bottom: 4px solid #38bdf8; 
            padding-bottom: 8px; 
            display: inline-block; 
        }

        /* =========================================
           4. FORMULÁRIOS
        ========================================= */
        .grupo-input { 
            margin-bottom: 20px; 
            width: 100%; 
        }
        
        label { 
            display: block; 
            font-weight: 600; 
            margin-bottom: 8px; 
            color: #334155; 
            font-size: 14px; 
        }
        
        .input-form { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #cbd5e1; 
            border-radius: 8px; 
            font-size: 14px; 
            outline: none; 
            transition: 0.3s; 
            background-color: #f8fafc; 
        }
        
        .input-form:focus { 
            border-color: #38bdf8; 
            background-color: #fff; 
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2); 
        }

        .flex-row { display: flex; gap: 15px; }
        .flex-1 { flex: 1; }

        /* =========================================
           5. TABELAS
        ========================================= */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; 
            background-color: white; 
            border-radius: 8px; 
            overflow: hidden; 
        }
        
        th { 
            background-color: #0f172a; 
            padding: 15px; 
            text-align: left; 
            color: white; 
            font-size: 12px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        
        td { 
            padding: 15px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 14px; 
            color: #475569; 
        }

        /* =========================================
           6. BOTÕES E CORES (FORÇADOS COM !IMPORTANT)
        ========================================= */
        .btn { 
            display: inline-block; 
            padding: 12px 20px; 
            border-radius: 8px; 
            text-decoration: none; 
            font-weight: 600; 
            cursor: pointer; 
            border: none; 
            transition: 0.3s; 
            text-align: center; 
        }
        
        .btn:hover { transform: translateY(-2px); }

        /* Azul - Padrão/Primário */
        .btn-blue, .btn-primary { 
            background-color: #0284c7 !important; 
            color: white !important; 
        }
        .btn-blue:hover { background-color: #0369a1 !important; }

        /* Verde - Sucesso/Concluir/Nova OS */
        .btn-success, .btn-concluir, a[href*="action=concluir"] { 
            background-color: #16a34a !important; 
            color: white !important; 
            padding: 10px 20px !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            display: inline-block !important;
        }
        .btn-success:hover { background-color: #15803d !important; }

        /* Laranja - Editar */
        .btn-edit, a.btn-acao-editar, a[href*="action=editar"] { 
            background-color: #f59e0b !important; 
            color: white !important; 
            padding: 6px 12px !important; 
            border-radius: 6px !important; 
            text-decoration: none !important; 
            font-weight: 600 !important; 
            font-size: 12px !important; 
            display: inline-block !important; 
            margin-right: 5px !important;
        }
        .btn-edit:hover { background-color: #d97706 !important; }

        /* Vermelho - Excluir */
        .btn-delete, a.btn-acao-excluir, a[href*="action=excluir"] { 
            background-color: #dc2626 !important; 
            color: white !important; 
            padding: 6px 12px !important; 
            border-radius: 6px !important; 
            text-decoration: none !important; 
            font-weight: 600 !important; 
            font-size: 12px !important; 
            display: inline-block !important; 
        }
        .btn-delete:hover { background-color: #b91c1c !important; }

        /* =========================================
           7. ESTILOS DO DASHBOARD (PAINEL)
        ========================================= */
        .dashboard-container { width: 100%; max-width: 1100px; margin: 0 auto; }
        
        .dash-banner { 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); 
            padding: 40px; 
            border-radius: 16px; 
            margin-bottom: 30px; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.2); 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 20px; 
        }
        
        .dash-banner h1 { color: #38bdf8; font-size: 28px; font-weight: 800; margin-bottom: 5px; }
        .dash-banner p { color: #cbd5e1; font-size: 16px; margin: 0; }
        
        .metric-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 20px; 
            margin-bottom: 40px; 
        }
        
        .metric-card { 
            background-color: white; 
            padding: 25px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
            transition: 0.3s;
        }
        
        .metric-card h4 { color: #64748b; font-size: 13px; text-transform: uppercase; margin-bottom: 5px; }
        .metric-card span { font-size: 32px; font-weight: 800; color: #0f172a; }
        
        .border-blue { border-left: 5px solid #0284c7; }
        .border-purple { border-left: 5px solid #8b5cf6; }
        .border-orange { border-left: 5px solid #f59e0b; }
        .border-red { border-left: 5px solid #ef4444; }

        .module-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px; 
        }
        
        .module-card { 
            background-color: white; 
            padding: 25px; 
            border-radius: 12px; 
            text-decoration: none; 
            color: #334155; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            border: 1px solid #e2e8f0; 
            transition: 0.3s; 
        }
        
        .module-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); border-color: #38bdf8; }
        .module-icon { padding: 15px; border-radius: 10px; font-size: 24px; }
        
        .icon-blue { background-color: #e0f2fe; color: #0284c7; }
        .icon-purple { background-color: #ede9fe; color: #8b5cf6; }
        .icon-orange { background-color: #fef3c7; color: #d97706; }
        .icon-green { background-color: #dcfce7; color: #16a34a; }

        /* =========================================
           8. ESTILOS DO LOGIN
        ========================================= */
        .login-wrapper { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            width: 100%; 
            position: absolute; 
            top: 0; 
            left: 0; 
            z-index: 10; 
        }
        
        .login-card { 
            background-color: #ffffff; 
            padding: 40px; 
            border-radius: 16px; 
            width: 100%; 
            max-width: 380px; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.5); 
            text-align: center; 
        }
        
        .btn-login { 
            width: 100%; 
            padding: 14px; 
            background-color: #0284c7; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 15px; 
            cursor: pointer; 
            transition: 0.3s; 
        }

        /* =========================================
           9. ALERTAS
        ========================================= */
        .alerta { padding: 15px; margin-bottom: 20px; border-radius: 8px; text-align: center; font-weight: 600; }
        .sucesso { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .erro { background-color: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

    </style>
</head>
<body>
    
    <?php if($controllerAtual != 'auth'): ?>
    <div class="overlay"></div>
    
    <div class="topbar">
        <a href="index.php?controller=dashboard" class="logo">⚙️ AutoMecânica</a>
        
        <nav class="topbar-nav">
            
            <div class="menu-item <?= $controllerAtual == 'dashboard' ? 'active' : '' ?>">
                <a href="index.php?controller=dashboard" class="menu-link">📊 Painel</a>
            </div>
            
            <div class="menu-item <?= $controllerAtual == 'cliente' ? 'active' : '' ?>">
                <span class="menu-link">👥 Clientes ▾</span>
                <div class="dropdown">
                    <a href="index.php?controller=cliente&action=consultar">Consultar Todos</a>
                    <a href="index.php?controller=cliente&action=cadastrar">Novo Cadastro</a>
                </div>
            </div>

            <div class="menu-item <?= $controllerAtual == 'veiculo' ? 'active' : '' ?>">
                <span class="menu-link">🚗 Veículos ▾</span>
                <div class="dropdown">
                    <a href="index.php?controller=veiculo&action=consultar">Consultar Frota</a>
                    <a href="index.php?controller=veiculo&action=cadastrar">Registar Veículo</a>
                </div>
            </div>

            <div class="menu-item <?= ($controllerAtual == 'os' || $controllerAtual == 'servico' || $controllerAtual == 'mecanico') ? 'active' : '' ?>">
                <span class="menu-link">🛠️ Oficina ▾</span>
                <div class="dropdown">
                    <a href="index.php?controller=os&action=consultar">Ordens de Serviço</a>
                    <a href="index.php?controller=os&action=cadastrar">Abrir Nova O.S.</a>
                    <hr style="border-color: #334155; margin: 5px 0;">
                    <a href="index.php?controller=mecanico&action=consultar">Equipe de Mecânicos</a>
                    <a href="index.php?controller=servico&action=consultar">Tabela de Serviços</a>
                </div>
            </div>

            <div class="menu-item <?= $controllerAtual == 'peca' ? 'active' : '' ?>">
                <span class="menu-link">📦 Estoque ▾</span>
                <div class="dropdown">
                    <a href="index.php?controller=peca&action=consultar">Lista de Peças</a>
                    <a href="index.php?controller=peca&action=cadastrar">Entrada de Peça</a>
                </div>
            </div>

            <div class="menu-item">
                <a href="index.php?controller=auth&action=logout" class="menu-link" style="color: #f87171; font-weight: 600;">🚪 Sair</a>
            </div>
            
        </nav>
    </div>
    
    <div class="conteudo">
    <?php endif; ?>