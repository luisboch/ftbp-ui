<?php

require_once 'ftbp-src/servicos/impl/ServicoRelatorioRequisicao.php';

require_once 'ftbp-src/entidades/basico/RelatorioRequisicao.php';

/**
 * Description of AvisoController
 *
 * @author felipe
 */
class RelatorioRequisicaoController extends MY_Controller {

    /**
     *
     * @var ServicoRelatorioRequisicao
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoRelatorioRequisicao();
    }

    public function index() {
        
        $this->checarAcesso(GrupoAcesso::RELATORIOS);
        
        $this->view('paginas/relatorioRequisicao');
    }

    public function gerarRelatorio() {
        
        $this->checarAcesso(GrupoAcesso::RELATORIOS);
        
        // Recupera o id que veio do form.
        $r = new RelatorioRequisicao();
        $r->setTipo($_POST['tipo']);
        $r->setDataInicio($_POST['dataInicio']);
        $r->setDataFim($_POST['dataFim']);

        $n = new RelatorioRequisicao();
        try {

            if ($r->getTipo() == 1) {
                $n = $this->servico->gerarRelatorioFechamento($r);
                $tipo = 'Fechamento';
            } else {
                $n = $this->servico->gerarRelatorioAbertura($r);
                $tipo = 'Abertura';
            }

            $this->view('paginas/verRelatorioRequisicao.php', array('reqst' => $n, 'r' => $r, 'titulo' => $tipo));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }
            
            $this->index();
        } catch (Exception $ex){
            $this->error($ex->getMessage());
            $this->index();
        }
    }

    public function gerarPdf() {

        $this->checarAcesso(GrupoAcesso::RELATORIOS);
        
        $tipo = $_POST['tipo'];
        $rq = new RelatorioRequisicao();
        $rq->setTipo($_POST['tipo']);
        $rq->setDataInicio($_POST['dataInicio']);
        $rq->setDataFim($_POST['dataFim']);

        if ($rq->getTipo() == '1') {
            $n = $this->servico->gerarRelatorioFechamento($rq);
        } else {
            $n = $this->servico->gerarRelatorioAbertura($rq);
        }

        $this->load->library('pdf'); // Load library
        // Generate PDF with FPDF
        
        $header = array('Nome', 'Departamento', 'Qtd');
        
        $data = array();
        
        
        foreach ($n as $r) {
            $data[] = array($r->getUsuario()->getNome(), $r->getDepartamento()->getNome(), $r->getQtde());
        }
        
        $this->pdf->SetTitle('Relatório de requisições');
        
        $this->pdf->AddPage();
        
        $this->pdf->setColumnSize(array(80, 80, 30));
        
        $this->pdf->FancyTable($header, $data);
        
        $this->pdf->Output('relatorio_requisicao_'.date('d-m-y_H-i').'.pdf', 'D');
    }

}

?>
