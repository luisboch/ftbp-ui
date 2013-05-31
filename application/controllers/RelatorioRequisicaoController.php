<?php

require_once 'ftbp-src/servicos/impl/ServicoRelatorioRequisicao.php';
require_once 'ftbp-src/entidades/basico/Requisicao.php';
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

        $n = new Requisicao();
        try {

            if ($r->getTipo() == 1) {
                $n = $this->servico->gerarRelatorioFechamento($r);
            }

            $this->view('paginas/verRelatorioRequisicao.php', array('reqst' => $n));
        } catch (ValidacaoExecao $e) {

            // Se não encontrar exibe 404
            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            exit;
        }
    }

    public function gerarPdf() {


        $this->load->library('pdf'); // Load library
        // Generate PDF by saying hello to the world

//        $header = array('Nome', 'Departamento', 'Quantidade');
//
//        $data = array('felipe','ti',10);
//        $this->pdf->AddPage();
//        $this->pdf->FancyTable($header,$data);
//        $this->pdf->Output();

        $this->load->library('cezpdf');

        $db_data = array();
        $db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com');
        $db_data[] = array('name' => 'Jane Doe', 'phone' => '222-333-4444', 'email' => 'jane.doe@something.com');
        $db_data[] = array('name' => 'Jon Smith', 'phone' => '333-444-5555', 'email' => 'jsmith@someplacepsecial.com');

        $col_names = array(
            'name' => 'Name',
            'phone' => 'Phone Number',
            'email' => 'E-mail Address'
        );

        $this->cezpdf->ezTable($db_data, $col_names, 'Contact List', array('width' => 550));
        $this->cezpdf->ezStream();
    }

}

?>
