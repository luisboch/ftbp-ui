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
        $this->checarAcesso(GrupoAcesso::SETOR, true);
        $this->view('paginas/cadastrarDepartamento.php');
    }

    public function salvar() {
        
        $this->checarAcesso(GrupoAcesso::SETOR, true);
        // Recupera o id que veio do form.
        $id = $_POST['id'];
        
        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Departamento();
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
            $n->setNome($_POST['nome']);

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Departamento " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");
            $this->view('paginas/cadastrarDepartamento.php', array('departamento' => $n));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarDepartamento.php', array('departamento' => $n));
        }
    }

    public function item() {
        $this->checarAcesso(GrupoAcesso::SETOR, false);
        $id = $this->uri->segment(3);
        $d = $this->servico->getById($id);
        $this->view('paginas/cadastrarDepartamento.php', array('departamento' => $d));
    }

}

?>
