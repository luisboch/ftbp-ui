<?php

require_once 'ftbp-src/servicos/impl/ServicoAviso.php';

/**
 * Description of AvisoController
 *
 * @author felipe
 */
class AvisoController extends MY_Controller {

    /**
     *
     * @var ServicoAviso
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoAviso();
    }

    public function index() {
        $this->view('paginas/cadastrarAviso.php');
    }

    public function salvar() {
        // Recupera o id que veio do form.
        $id = $_POST['id'];
        
        echo $_POST['id'];
       
        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Aviso();
            } else {
                $n = $this->servico->getById($id);
            }
        } catch (NoResultException $e) {
            // Se não encontrar exibe 404
            show_404();
            exit;
        }

        // Inicia bloco de controle
        try {
            
            // Seta os novos valores
            $n->setTitulo($_POST['titulo']);
            $n->setDescricao($_POST['descricao']);
            

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Cadastrado " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");
            $this->view('paginas/cadastrarAviso.php', array('aviso' => $n));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarAviso.php', array('aviso' => $n));
        }
    }

    public function item() {
        $id = $this->uri->segment(3);
        $d = $this->servico->getById($id);
        $this->view('paginas/cadastrarDepartamento.php', array('departamento' => $d));
    }

}

?>
