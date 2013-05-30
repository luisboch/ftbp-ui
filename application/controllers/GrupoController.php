<?php

require_once 'ftbp-src/servicos/impl/ServicoGrupo.php';

/**
 * Description of GrupoController
 *
 * @author felipe
 */
class GrupoController extends MY_Controller {

    /**
     *
     * @var ServicoGrupo
     */
    private $servico;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoGrupo();
    }

    public function index() {
        $this->view('paginas/cadastrarGrupo.php');
    }

    public function salvar() {
        // Recupera o id que veio do form.
        $id = $_POST['id'];
        
        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Grupo();
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
            
            // Carrega os acessos
            // Limpa os acessos carregados
            $n->setAcessos(array());
            
            // Executa um loop e cadastr os novos acessos.
            for($i = 1; $i < 15; $i++){
                if ($_POST['r_'.$i] === 'on') {
                  $escrita = $_POST['w_'.$i] === 'on';
                  $n->adicionarAcesso($i, $escrita);
                } 
            }

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Grupo " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");
            $this->view('paginas/cadastrarGrupo.php', array('grupo' => $n));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarGrupo.php', array('grupo' => $n));
        }
    }

    public function item() {
        $id = $this->uri->segment(3);
        $d = $this->servico->getById($id);
        $this->view('paginas/cadastrarGrupo.php', array('grupo' => $d));
    }

}

?>
