<?php

require_once 'ftbp-src/servicos/impl/ServicoEvento.php';
require_once 'ftbp-src/entidades/basico/Evento.php';

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

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoEvento();
        
    }

    public function index() {
   
        $this->view('paginas/cadastrarEvento.php');
    }

    public function salvar() {
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
            $n->setDataEvento($_POST['data']);
            $n->setLocal($_POST['local']);
            $n->setContato($_POST['contato']);

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Evento " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");

            $this->view('paginas/cadastrarEvento.php', array('evento' => $n));

            } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarEvento.php', array('evento' => $n));
        }
    }
    
    public function verEvento(){
    
        $id = $this->uri->segment(3);
        
        $ev = new Evento();
        
        $ev = $this->servico->getById($id);
        
        $this->view('paginas/verEvento.php', array('evento' => $ev));
    }

    public function verMais(){
        
        $cr = new Evento();
        $cr = $this->servico->carregarEvento();
        
        $this->view('paginas/evento.php', array('evento' => $cr));
    }
    
    public function alterarEvento(){
        
        $id = $this->uri->segment(3);
        
        $cr = new Evento();
        
        $cr = $this->servico->getById($id);
        
        $this->view('paginas/cadastrarEvento.php', array('evento' => $cr));
        
    }
    /*
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
