<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';

require_once 'ftbp-src/entidades/basico/Curso.php';

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
     * @var ServicoUsuario 
     */


    function __construct() {
        parent::__construct();
        $this->servico = new ServicoCurso();
    }

    public function index() {
        
        $this->view('paginas/cadastrarCurso.php');
    }
/*
    public function salvar() {
        // Recupera o id que veio do form.
        $id = $_POST['id'];

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

            $usuariosAenviar = array();
            // verificar se é para enviar para todos os usuários 
            if ($_POST['todos'] === 'on') {
                // pega os usuários
                $usuariosAenviar = $this->servicoUsuario->carregarTodosOsUsuarios();
            } else {
                if ($_POST['setor_resp'] === 'on') {
                    
                    $responsaveis = $this->servicoUsuario->carregarResponsavelDepartamento($_POST['setor_resp_check']);
                    
                    foreach ($responsaveis as $v) {
                        $usuariosAenviar[] = $v;
                    }
                    
                }
                if ($_POST['setor_usuarios'] === 'on') {
                    $usuarios = $this->servicoUsuario->carregarUsuariosDepartamento($_POST['setor_usu_check']);
                    foreach($usuarios as $v){
                        $usuariosAenviar[] = $v;
                    }
                }
                if ($_POST['usuario'] === 'on') {
                    $usuarios = $this->servicoUsuario->getByIds($_POST['usuario_check']);
                    foreach($usuarios as $v){
                        $usuariosAenviar[] = $v;
                    }
                }
            }

            $n->setUsuariosAlvo($usuariosAenviar);

            // Seta os novos valores

            $n->setTitulo($_POST['titulo']);

            $n->setDescricao($_POST['descricao']);

            $n->setCriadoPor($this->session->getUsuario());

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Aviso " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");

            $dptos = $this->servicoDepartamento->carregarDepartamentos();
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();

            $this->view('paginas/cadastrarAviso.php', array('aviso' => $n, 'dptos' => $dptos, 'usuarios' => $usuarios));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $dptos = $this->servicoDepartamento->carregarDepartamentos();
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();

            $this->view('paginas/cadastrarAviso.php', array('aviso' => $n, 'dptos' => $dptos, 'usuarios' => $usuarios));
        }
    }
    
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
