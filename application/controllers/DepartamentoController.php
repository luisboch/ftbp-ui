<?php

require_once 'ftbp-src/servicos/impl/ServicoDepartamento.php';

/**
 * Description of DepartamentoController
 *
 * @author felipe
 */
class DepartamentoController extends MY_Controller {

    /**
     *
     * @var ServicoDepartamento
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoDepartamento();
    }

    public function index() {
        $this->view('paginas/cadastrarDepartamento.php');
    }

    public function salvar() {
        // Inicia bloco de controle
        try {
            
            // Recupera o id que veio do form.
            $id = $_POST['id'];

            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Departamento();
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
            $this->addMessage("Departamento ".($id == ''?'cadastrado':'atualizado')." com sucesso");
            $this->view('paginas/cadastrarDepartamento.php',array('departamento' => $n));
            
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->addMessage($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarDepartamento.php');
        } catch (NoResultException $e){
            show_404();
        }
    }

    public function item() {
        $id = $this->uri->segment(3);
        $d = $this->servico->getById($id);
        $this->view('paginas/cadastrarDepartamento.php', array('departamento' => $d));
    }

}

?>
