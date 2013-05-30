<?php

require_once 'ftbp-src/servicos/impl/ServicoRelatorioRequisicao.php';
require_once 'ftbp-src/entidades/basico/Requisicao.php';
require_once 'ftbp-src/entidades/basico/Relatorio.php';

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
        $r = new Relatorio;
        $r->setTipo($_POST['tipo']);
        $r->setDataInicio($_POST['dataInicio']);
        $r->setDataFim($_POST['dataFim']);

        $n = new Requisicao();
        try {
            $n = $this->servico->gerarRelatorio($r);


            $this->view('paginas/verRelatorioRequisicao.php', array('reqst' => $n));
        
            
        } catch (ValidacaoExecao $e) {
    
            // Se não encontrar exibe 404
            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }
            
            exit;
        }
    }

    /*
      public function verAviso(){

      $id = $this->uri->segment(3);

      $at = new Aviso();

      $at->setId($id);

      $av = $this->servico->avisoLido($at, $this->session->getUsuario());


      $av = $this->servico->getById($id);

      $this->view('paginas/lerAviso.php', array('aviso' => $av));
      }


      public function verMais(){

      $av =  $this->servico->carregarAviso($this->session->getUsuario());

      $this->view('paginas/avisos.php', array ('aviso' => $av, 'titulo' => 'Entrada de Avisos', 'opcao' => 'entrada'));
      }

      public function meusAvisos(){

      $av =  $this->servico->carregarMeusAviso($this->session->getUsuario());
      $this->view('paginas/avisos.php', array ('aviso' => $av, 'titulo' => 'Meus Avisos', 'opcao' => 'saida'));

      }

      public function deletarAviso(){

      $id = $this->uri->segment(3);
      $opcao = $this->uri->segment(4);
      $at = new Aviso();
      $at->setId($id);

      if ($opcao === "saida"){
      $av = $this->servico->remover($at);
      $av = $this->servico->carregarMeusAviso($this->session->getUsuario());
      }else if ($opcao === "entrada"){
      $av = $this->servico->deletarAvisoDestinatario($at, $this->session->getUsuario());
      $av = $this->servico->carregarAviso($this->session->getUsuario());
      }
      $this->info("Aviso " . ('deletado') . " com sucesso");
      $this->view('paginas/avisos.php', array ('aviso' => $av, 'titulo' => 'Meus Avisos', 'opcao' => $opcao));
      }
     */
}

?>
