<?php

require_once 'ftbp-src/servicos/impl/ServicoAviso.php';
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
require_once 'ftbp-src/servicos/impl/ServicoDepartamento.php';
require_once 'ftbp-src/entidades/basico/Aviso.php';

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

    /**
     *
     * @var ServicoUsuario 
     */
    private $servicoUsuario;

    /**
     *
     * @var ServicoDepartamento 
     */
    private $servicoDepartamento;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoAviso();
        $this->servicoUsuario = new ServicoUsuario();
        $this->servicoDepartamento = new ServicoDepartamento();
    }

    public function index() {
        $dptos = $this->servicoDepartamento->carregarDepartamentos();
        $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
        $this->view('paginas/cadastrarAviso.php', array('dptos' => $dptos, 'usuarios' => $usuarios));
    }

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

            $n->setNome($_POST['nome']);

            $n->setDescricao($_POST['descricao']);

            $n->setCriadoPor($this->session->getUsuario());

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Cadastrado " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");

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

    public function item() {
        $id = $this->uri->segment(3);
        
        $at = new Aviso();
        
        $at->setId($id);
        
        //$av = $this->servico->avisoLido($at, $this->session->getUsuario());
        
        
        $av = $this->servico->getById($id);
        
        $this->view('paginas/lerAviso.php', array('aviso' => $av));
    }

}

?>
