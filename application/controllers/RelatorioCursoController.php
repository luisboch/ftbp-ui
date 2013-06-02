<?php

require_once 'ftbp-src/servicos/impl/ServicoRelatorioCurso.php';

/**
 * Description of AvisoController
 *
 * @author luis
 */
class RelatorioCursoController extends MY_Controller {

    /**
     * @var ServicoRelatorioCurso
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoRelatorioCurso();
    }

    public function index() {

        $this->view('paginas/relatorioCurso.php');
    }

    public function gerarRelatorio() {

        // Verifica se o parametro é válido. Se não for adiciona o valor default.
        $tipo = $_POST['tipo'];

        if ($tipo == '' || !is_numeric($tipo)) {
            $tipo = CursoAgrupamento::CURSO;
        }

        try {

            $resultado = $this->servico->dadosRelatorioVisualizacao($tipo);

            $this->view('paginas/verRelatorioCurso.php', array('reslt' => $resultado,
                'tipo' => $tipo));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->index();

            exit;
        }
    }

    public function gerarPdf() {

        $tipo = $_POST['tipo'];

        if ($tipo == '' || !is_numeric($tipo)) {
            $tipo = CursoAgrupamento::CURSO;
        }

        try {

            /* @var $resultado CursoRelatorioResultado[] */
            
            $resultado = $this->servico->dadosRelatorioVisualizacao($tipo);

            $this->load->library('pdf'); // Load library
            
            $header = array(CursoAgrupamento::getCabecalho($tipo), 'Quantidade de Acessos');

            $data = array();


            foreach ($resultado as $r) {
                switch ($tipo) {
                    case CursoAgrupamento::CURSO:
                        $nome = $r->getCurso();
                        break;
                    case CursoAgrupamento::CURSO_AREA:
                        $nome = $r->getArea();
                        break;
                    case CursoAgrupamento::NIVEL:
                        $nome = ucfirst($r->getNivelgraduacao());
                        break;
                    default:
                        break;
                }
                $data[] = array($nome, $r->getAcessos());
            }

            $this->pdf->SetTitle('Relatório de Visualizações de Cursos');

            $this->pdf->AddPage();

            $this->pdf->setColumnSize(array(100, 90));

            $this->pdf->FancyTable($header, $data);

            $this->pdf->Output('relatorio_curso_' . date('d-m-y_H-i') . '.pdf', 'D');
            
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->index();

            exit;
        }
    }

}

?>
