<?php
// Identifica qual o controller atual para destacar o menu ativo
$controllerAtual = $_GET['controller'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMecânica Pro - Gestão MVC</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        /* Configurações Globais */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            color: #333; 
            background: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed; 
            background-size: cover; 
        }
        /* Botão Editar - Laranja */
a.btn-acao-editar { 
    background-color: #f59e0b !important; 
    color: white !important; 
    padding: 6px 12px !important; 
    border-radius: 5px !important; 
    text-decoration: none !important; 
    font-weight: 600 !important; 
    font-size: 13px !important;
    display: inline-block !important;
    margin-right: 5px !important;
}

/* Botão Excluir - Vermelho */
a.btn-acao-excluir { 
    background-color: #dc2626 !important; 
    color: white !important; 
    padding: 6px 12px !important; 
    border-radius: 5px !important; 
    text-decoration: none !important; 
    font-weight: 600 !important; 
    font-size: 13px !important;
    display: inline-block !important;
}
        
        .overlay { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(15, 23, 42, 0.85); 
            z-index: -1; 
        }
        
        /* Barra de Navegação (Topbar) */
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
        
        .logo { font-size: 22px; color: #38bdf8; font-weight: 800; text-transform: uppercase; text-decoration: none; }
        
        .topbar-nav { display: flex; height: 100%; }
        
        .menu-item { position: relative; display: flex; align-items: center; height: 100%; }
        
        .menu-link { 
            color: #cbd5e1; 
            text-decoration: none; 
            padding: 0 15px; 
            height: 100%; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: 500; 
            font-size: 14px; 
            transition: 0.3s; 
            cursor: pointer; 
        }
        
        .menu-link:hover, .menu-item.active > .menu-link { color: #38bdf8; background: rgba(255,255,255,0.05); }
        
        /* Dropdown Menu */
        .dropdown { 
            position: absolute; 
            top: 70px; 
            left: 0; 
            background-color: #1e293b; 
            min-width: 220px; 
            display: none; 
            flex-direction: column; 
            border-top: 2px solid #38bdf8; 
            box-shadow: 0 10px 15px rgba(0,0,0,0.3);
            z-index: 200;
        }
        
        .menu-item:hover .dropdown { display: flex; }
        
        .dropdown a { 
            color: #cbd5e1; 
            padding: 12px 20px; 
            text-decoration: none; 
            font-size: 13px; 
            border-bottom: 1px solid #334155; 
            transition: 0.3s;
        }
        
        .dropdown a:hover { background-color: #334155; color: white; padding-left: 25px; }

        /* Estrutura de Conteúdo */
        .conteudo { flex: 1; padding: 40px; display: flex; flex-direction: column; align-items: center; z-index: 1; }
        
        .cartao { 
            background: rgba(255, 255, 255, 0.98); 
            width: 100%; 
            padding: 35px; 
            border-radius: 15px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.4); 
            margin-bottom: 25px; 
        }
        
        .card-lg { max-width: 1000px; }
        .card-sm { max-width: 600px; }
        
        .cartao h3 { 
            margin-bottom: 25px; 
            color: #0f172a; 
            font-size: 24px; 
            border-bottom: 4px solid #38bdf8; 
            padding-bottom: 8px; 
            display: inline-block;
        }
        
        /* Tabelas */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: white; border-radius: 8px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        th { background: #0f172a; color: white; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }

        /* --- BOTÕES E CORES (CORREÇÃO DEFINITIVA) --- */
        
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
        
        /* Botão Azul (Primário) */
        .btn-blue { background-color: #0284c7 !important; color: white !important; }
        .btn-blue:hover { background-color: #0369a1 !important; }
        
        /* Botão Verde (Sucesso/Concluir) */
        .btn-success { background-color: #16a34a !important; color: white !important; }
        .btn-success:hover { background-color: #15803d !important; }

        /* Botão Laranja (Editar) */
        a.btn-edit { 
            display: inline-block !important;
            background-color: #f59e0b !important; 
            color: #ffffff !important; 
            font-size: 12px !important; 
            font-weight: 600 !important; 
            padding: 6px 12px !important; 
            border-radius: 5px !important; 
            margin-right: 5px !important; 
            text-decoration: none !important; 
            transition: 0.3s;
        }
        a.btn-edit:hover { background-color: #d97706 !important; }
        
        /* Botão Vermelho (Excluir) */
        a.btn-delete { 
            display: inline-block !important;
            background-color: #dc2626 !important; 
            color: #ffffff !important; 
            font-size: 12px !important; 
            font-weight: 600 !important; 
            padding: 6px 12px !important; 
            border-radius: 5px !important; 
            text-decoration: none !important; 
            transition: 0.3s;
        }
        a.btn-delete:hover { background-color: #b91c1c !important; }

        /* Formulários e Utilitários */
        .grupo-input { margin-bottom: 20px; width: 100%; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #334155; font-size: 14px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; }
        input:focus, select:focus { border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2); }
        .flex-row { display: flex; gap: 15px; }
        .flex-1 { flex: 1; }
        
        /* Alertas */
        .alerta { padding: 15px; margin-bottom: 20px; border-radius: 8px; text-align: center; font-weight: 600; font-size: 14px; }
        .sucesso { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .erro { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
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
                <div class="menu-link">👥 Clientes ▾</div>
                <div class="dropdown">
                    <a href="index.php?controller=cliente&action=consultar">Consultar Todos</a>
                    <a href="index.php?controller=cliente&action=cadastrar">➕ Cadastrar Novo</a>
                </div>
            </div>

            <div class="menu-item <?= $controllerAtual == 'veiculo' ? 'active' : '' ?>">
                <div class="menu-link">🚗 Veículos ▾</div>
                <div class="dropdown">
                    <a href="index.php?controller=veiculo&action=consultar">Consultar Frota</a>
                    <a href="index.php?controller=veiculo&action=cadastrar">➕ Registar Veículo</a>
                </div>
            </div>

            <div class="menu-item <?= $controllerAtual == 'peca' ? 'active' : '' ?>">
                <div class="menu-link">📦 Stock ▾</div>
                <div class="dropdown">
                    <a href="index.php?controller=peca&action=consultar">Ver Peças</a>
                    <a href="index.php?controller=peca&action=cadastrar">➕ Adicionar Peça</a>
                </div>
            </div>

            <div class="menu-item <?= ($controllerAtual == 'os' || $controllerAtual == 'servico' || $controllerAtual == 'mecanico') ? 'active' : '' ?>">
                <div class="menu-link">🛠️ Oficina ▾</div>
                <div class="dropdown">
                    <a href="index.php?controller=os&action=consultar">Ordens de Serviço</a>
                    <a href="index.php?controller=os&action=cadastrar">📝 Abrir Nova O.S.</a>
                    <hr style="border-color: #334155; margin: 5px 0;">
                    <a href="index.php?controller=mecanico&action=consultar">Equipe Técnica</a>
                    <a href="index.php?controller=servico&action=consultar">Tabela de Mão de Obra</a>
                </div>
            </div>

            <div class="menu-item">
                <a href="index.php?controller=auth&action=logout" class="menu-link" style="color: #ef4444;">🚪 Sair</a>
            </div>
            
        </nav>
    </div>
    <div class="conteudo">
    <?php endif; ?>