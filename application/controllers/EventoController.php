<?php

require_once 'ftbp-src/servicos/impl/ServicoEvento.php';
require_once 'ftbp-src/entidades/basico/Evento.php';
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';

/**
 * Description of EventoController
 *
 * @author felipe
 */
class EventoController extends MY_Controller {

    /**
     *
     * @var ServicoEvento
     */
    private $servico;
    
    /**
     * @var ServicoUsuario
     */
    private $servicoUsuario;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoEvento();
        $this->servicoUsuario = new ServicoUsuario();
        
    }

    /**
     * 
     * @return Usuario[]
     */
    private function carregarUsuarios() {
        return $this->servicoUsuario->carregarTodosOsUsuarios();
    }
    
    public function index() {
        $this->checarAcesso(GrupoAcesso::EVENTO, true);
        
        $this->view('paginas/cadastrarEvento.php', array('usuarios' => $this->carregarUsuarios()));
    }

    public function salvar() {
        
        $this->checarAcesso(GrupoAcesso::EVENTO, true);
        // Recupera o id que veio do form.
        $id = $_POST['id'];

        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Evento();
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
            // Cria o objeto DateTime de acordo com a data enviada do formulário
            $dt = DateTime::createFromFormat('d/m/Y', $_POST["data"]);
            $n->setDataEvento($dt);
			
            $n->setLocal($_POST['local']);
            
            if($_POST['contato_id']!= ''){
                $contato = $this->servicoUsuario->getById($_POST['contato_id']);
                $n->setContato($contato);
            } else {
                $n->setContato(NULL);
            }

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Evento " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");

            $this->view('paginas/cadastrarEvento.php', array('evento' => $n, 'usuarios' => $this->carregarUsuarios()));

            } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarEvento.php', array('evento' => $n, 'usuarios' => $this->carregarUsuarios()));
        }
    }
    
    public function verEvento(){
        $this->checarAcesso(GrupoAcesso::EVENTO, FALSE);
        $id = $this->uri->segment(3);
        
        $ev = new Evento();
        
        $ev = $this->servico->getById($id);
        
        $this->view('paginas/verEvento.php', array('evento' => $ev, 'usuarios' => $this->carregarUsuarios()));
    }

    public function verMais(){
        $this->checarAcesso(GrupoAcesso::EVENTO, false);
        $cr = new Evento();
        $cr = $this->servico->carregarEvento();
        
        $this->view('paginas/evento.php', array('evento' => $cr));
    }
    
    public function alterarEvento(){
        $this->checarAcesso(GrupoAcesso::EVENTO, true);
        $id = $this->uri->segment(3);
        
        $cr = new Evento();
        
        $cr = $this->servico->getById($id);
        
        $this->view('paginas/cadastrarEvento.php', array('evento' => $cr, 'usuarios' => $this->carregarUsuarios()));
        
    }
}

?>