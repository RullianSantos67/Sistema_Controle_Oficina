<?php
class SobreController {
    
    // O sistema sempre pede uma conexão no __construct
    public function __construct($conexao = null) {
    }

    public function sobre() {
        // Apenas carrega a tela "Sobre Nós"
        require_once "views/sobre/sobre.php";
    }
}