<?php
class DashboardController {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    public function index() {
        // Inicializa as variáveis
        $totalCli = 0; $totalVei = 0; $totalOs = 0; $pecasBaixas = 0;
        
        try {
            // O Controller pede os dados para o banco
            $totalCli = $this->db->query("SELECT COUNT(*) FROM cliente")->fetchColumn() ?: 0;
            $totalVei = $this->db->query("SELECT COUNT(*) FROM veiculo")->fetchColumn() ?: 0;
            $totalOs = $this->db->query("SELECT COUNT(*) FROM ordem_servico WHERE status != 'Concluída'")->fetchColumn() ?: 0;
            $pecasBaixas = $this->db->query("SELECT COUNT(*) FROM peca WHERE quantidade_estoque <= 3")->fetchColumn() ?: 0;
        } catch (Exception $e) {
            // Em caso de erro, ignora e mantém zero
        }

        // O Controller chama a View e passa as variáveis prontas para ela
        require 'views/dashboard/painel.php'; 
    }
}