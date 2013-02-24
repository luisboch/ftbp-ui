<?php
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
/*
 * Usuarios.php
 */

/**
 * Description of Usuarios
 *
 * @author Luis
 * @since Feb 24, 2013
 */
class UsuariosController extends MY_Controller{
    
    /**
     * @var ServicoUsuario
     */
    private $servico;
    
    function __construct() {
        parent::__construct();
        $this->servico = new ServicoUsuario();
    }

    public function index(){
        $this->registro();
    }
    
    public function registro(){
        $this->load->view('basic/usuario_form.php');
    }
    
    public function salvar(){
        $usuario = new Aluno();
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $this->servico->inserir($usuario);
        echo 'usuario registrado id:'.$usuario->getId();
    }
}

?>
