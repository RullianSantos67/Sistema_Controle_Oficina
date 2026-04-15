<?php
require_once 'models/OrdemServico.php';

class OsController {
    private $osModel;

    public function __construct($db) {
        $this->osModel = new OrdemServico($db);
    }

    // Tela de listagem principal
    public function consultar() {
        $ordens = $this->osModel->consultarOS();
        require 'views/os/consultar.php';
    }

    // Processo de abertura de nova O.S.
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':entrada'  => date('Y-m-d'),
                ':previsao' => $_POST['data_previsao'],
                ':status'   => $_POST['status'],
                ':veiculo'  => $_POST['id_veiculo'],
                ':mecanico' => $_POST['id_mecanico']
            ];
            $this->osModel->cadastrar($dados);
            header('Location: index.php?controller=os&action=consultar');
            exit;
        } else {
            $veiculos = $this->osModel->obterVeiculos();
            $mecanicos = $this->osModel->obterMecanicos();
            require 'views/os/cadastrar.php';
        }
    }

    // Tela de Detalhes (Adicionar Itens e Concluir)
    public function detalhes() {
        $id_os = $_GET['id'] ?? null;
        if (!$id_os) { header('Location: index.php?controller=os&action=consultar'); exit; }

        $mensagem = "";
        
        // Processa adição de Peça ou Serviço
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                if (isset($_POST['id_peca'])) {
                    $this->osModel->adicionarPeca($id_os, $_POST['id_peca'], $_POST['quantidade']);
                }
                if (isset($_POST['id_servico'])) {
                    $this->osModel->adicionarServico($id_os, $_POST['id_servico'], $_POST['horas']);
                }
                
                // Recalcula o valor total da O.S. automaticamente
                $this->osModel->atualizarValorTotal($id_os);
                $mensagem = "<div class='alerta sucesso'>✅ Item adicionado com sucesso!</div>";
            } catch (Exception $e) {
                $mensagem = "<div class='alerta erro'>❌ " . $e->getMessage() . "</div>";
            }
        }

        // Busca dados para exibir na View
        $os = $this->osModel->consultarOsID($id_os);
        $listaPecas = $this->osModel->listarPecasDisponiveis();
        $listaServicos = $this->osModel->listarServicosDisponiveis();
        $pecas_usadas = $this->osModel->pecasDaOs($id_os);
        $servicos_feitos = $this->osModel->servicosDaOs($id_os);

        require 'views/os/detalhes.php';
    }

    // Ação de concluir a O.S.
    public function concluir() {
        $id_os = $_GET['id'] ?? null;
        if ($id_os) {
            $this->osModel->concluirOS($id_os);
            header("Location: index.php?controller=os&action=consultar");
            exit;
        }
    }
}
?>