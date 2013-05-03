<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';
require_once 'ftbp-src/servicos/impl/ServicoArea.php';

require_once 'ftbp-src/entidades/basico/Curso.php';
require_once 'ftbp-src/entidades/basico/AreaCurso.php';

/**
 * Description of AvisoController
 *
 * @author felipe
 */
class CursoController extends MY_Controller {

    /**
     *
     * @var ServicoAviso
     */
    private $servico;
    
    /**
     *
     * @var ServicoArea 
     */
    private $servicoArea;

    /**
     *
     * @var ServicoUsuario 
     */


    function __construct() {
        parent::__construct();
        $this->servico = new ServicoCurso();
        $this->servicoArea = new ServicoArea();
    }

    public function index() {
        
        
        
        $areaCurso = new AreaCurso();
        
        $areaCurso = $this->servicoArea->carregarArea();
        
        $this->view('paginas/cadastrarCurso.php', array('area' => $areaCurso));
    }

    public function salvar() {
        // Recupera o id que veio do form.
        $id = $_POST['id'];

        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Curso();
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

            $n->setId($id);
            $n->setNome($_POST['nome']);
            $n->setDescricao($_POST['descricao']);
            $n->setAreaCurso($_POST['areaCurso']);
            $n->setContatoSecretaria($_POST['contatoSecretaria']);
            $n->setCoordenador($_POST['coordenador']);
            $n->setCorpoDocente($_POST["corpoDocente"]);
            $n->setDataVestibular($_POST["dataVestibular"]);
            $n->setDescricao($_POST['descricao']);
            $n->setDuracao($_POST['duracao']);
            $n->setNivelGraduacao($_POST['nivelGraduacao']);
            $n->setPublicoAlvo($_POST['publicoAlvo']);
            $n->setValor($_POST['valor']);
            $n->setVideoApresentacao($_POST['videoApresentacao']);
            $n->setEmail($_POST['email']);
            $n->setCredito($_POST['credito']);
            // Chama o salvar, (atualiza ou insere)
            
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            
            $this->info("Curso " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");
            
            $areaCurso = new AreaCurso();
        
            $areaCurso = $this->servicoArea->carregarArea();
            
            $this->view('paginas/cadastrarCurso.php', array('curso' => $n, 'area' => $areaCurso));
            
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastrarCurso.php', array('curso' => $n));
        }
    }
    
    public function verCurso(){
    
        $id = $this->uri->segment(3);
        
        $cr = new Curso();
        
        $cr = $this->servico->getById($id);
        
        $this->view('paginas/verCurso.php', array('curso' => $cr));
    }
    
    public function verMais(){
        
        $cr = new Curso();
        $cr =  $this->servico->carregarCurso();
        
        $this->view('paginas/curso.php',array('titulo' => 'Cursos', 'curso' => $cr));
    }
    /*
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
