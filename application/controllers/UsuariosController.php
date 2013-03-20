<?php

require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
require_once 'ftbp-src/servicos/impl/ServicoDepartamento.php';
/*
 * Usuarios.php
 */

/**
 * Description of Usuarios
 *
 * @author Luis
 * @since Feb 24, 2013
 */
class UsuariosController extends MY_Controller {

    /**
     * @var ServicoUsuario
     */
    private $servico;
    
    /**
     * @var ServicoDepartamento
     */
    private $servicoDepartamento;

    function __construct() {
        
        parent::__construct();
        $this->servico = new ServicoUsuario();
        $this->servicoDepartamento = new ServicoDepartamento();
        
    }

    public function index() {
        $this->registro();
    }

    public function registro() {
        $id = $this->uri->segment(3);
        if ($id != null) {
            $usuario = $this->servico->getById($id);
            $this->view('paginas/cadastroUsuario.php',
                    array('usuario' => $usuario,
                        'deptos' => $this->servicoDepartamento->carregarDepartamentos()));
        } else {
            $this->view('paginas/cadastroUsuario.php',array( 'deptos' => $this->servicoDepartamento->carregarDepartamentos()));
        }
    }

    public function salvar() {

        // Inicia bloco de controle
        try {

            // Recupera o id que veio do form.
            $id = $_POST['id'];

            // Se estiver vazio é novo.
            if ($id == '') {
                $usuario = new Usuario();
            } else {
                $usuario = $this->servico->getById($id);
            }

            // Seta os novos valores
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);
            $usuario->setNome($_POST['nome']);
            $usuario->setTipoUsuario(
                    TipoUsuario::valueOf($_POST['tipo_usuario']));
            
            if($_POST['departamento'] != ''){
                $usuario->setDepartamento(
                        $this->servicoDepartamento->getById($_POST['departamento']));
            }
            
            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($usuario);
            } else {
                $this->servico->atualizar($usuario);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Usuário " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");
            $this->view('paginas/cadastroUsuario.php', 
                    array('usuario' => $usuario,
                        'deptos' => $this->servicoDepartamento->carregarDepartamentos()));
        } catch (ValidacaoExecao $e) {

            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            $this->view('paginas/cadastroUsuario.php', array('usuario' => $usuario,
                        'deptos' => $this->servicoDepartamento->carregarDepartamentos()));
        } catch (NoResultException $e) {
            show_404();
        }
    }

}

?>
