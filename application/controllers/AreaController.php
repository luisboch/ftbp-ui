<?php

require_once 'ftbp-src/servicos/impl/ServicoArea.php';

/**
 * Description of DepartamentoController
 *
 * @author felipe
 */
class AreaController extends MY_Controller {

    /**
     *
     * @var ServicoDepartamento
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoArea();
    }

    public function index() {
        $this->view('paginas/cadastrarArea.php');
    }

    public function salvar() {
        
        // Inicia bloco de controle
        try {
            
            // Recupera o id que veio do form.
            $id = $_POST['id'];

            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new AreaCurso();
            } else {
                $n = $this->servico->getById($id);
            }
            
            // Seta os novos valores
            $n->setNome($_POST['nome']);
            
            // Chama o salvar, (atualiza ou insere)
            if($id == ''){
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }
            
            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Area ".($id == ''?'cadastrada':'atualizada')." com sucesso");
            $this->view('paginas/cadastrarArea.php',array('area' => $n));
            
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarArea.php');
        } catch (NoResultException $e){
            show_404();
        }
    }

    public function item() {
        $id = $this->uri->segment(3);
        $d = $this->servico->getById($id);
        $this->view('paginas/cadastrarArea.php', array('area' => $d));
    }

}

?>
