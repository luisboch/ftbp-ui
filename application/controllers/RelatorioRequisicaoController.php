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
     * @var ServicoAviso
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoRelatorioRequisicao();
    }

    public function index() {

        $this->view('paginas/relatorioRequisicao');
    }

    public function gerarRelatorio() {
        // Recupera o id que veio do form.
        $r = new RelatorioRequisicao();
        $r->setTipo($_POST['tipo']);
        $r->setDataInicio($_POST['dataInicio']);
        $r->setDataFim($_POST['dataFim']);

        $n = new RelatorioRequisicao();
        try {

            if ($r->getTipo() == 1) {
                $n = $this->servico->gerarRelatorioFechamento($r);
                //$n->setDataInicio($r->getDataInicio());
                //$n->setDataFim($_POST['dataFim']);
                $tipo = 'Fechamento';
            } else {
                $n = $this->servico->gerarRelatorioAbertura($r);
//                $n->setDataInicio($_POST['dataInicio']);
//                $n->setDataFim($_POST['dataFim']);
                $tipo = 'Abertura';
            }

            $this->view('paginas/verRelatorioRequisicao.php', array('reqst' => $n, 'tipo' => $tipo));
        } catch (ValidacaoExecao $e) {

            // Se não encontrar exibe 404
            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            exit;
        }
    }

    public function gerarPdf() {

        $tipo = $_POST['tipo'];
        $rq = new RelatorioRequisicao();

        $rq = $_POST['reqst'];
        
        $this->load->library('pdf'); // Load library
        // Generate PDF with FPDF
//        $header = array('Nome', 'Departamento', 'Quantidade');
//
//        $data = array('felipe','ti',10);
//        $this->pdf->AddPage();
//        $this->pdf->FancyTable($header,$data);
//        $this->pdf->Output();

        $this->load->library('cezpdf');

        $db_data = array();

        foreach ($rq as $r) {
            $db_data[] = array('nome' => $r->getNome(), 'departamento' => $r->getDepartamento()->getNome(), 'qtde' => $r->getQtde());
        }
        $db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com');

        //var_dump($db_data);

        $col_names = array(
            'nome' => 'Nome',
            'departamento' => 'Departamento',
            'qtde' => 'Quantidade'
        );

        $this->cezpdf->ezTable($db_data, $col_names, 'Relatorio Requisicoes ' . $_POST['tipo'], array('width' => 550));
//        $this->cezpdf->ezStream();
    }

}

?>
