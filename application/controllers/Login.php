<?php

require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
require_once 'ftbp-src/servicos/impl/ServicoChat.php';
/*
 * LoginService.php
 */

/**
 * Description of LoginService
 *
 * @author Luis
 * @since Feb 24, 2013
 */
class Login extends MY_Controller {

    /**
     *
     * @var ServicoUsuario
     */
    private $service;
    
    /**
     *
     * @var Chat
     */
    private $chatService;
            
    function __construct() {
        parent::__construct();
        $this->service = new ServicoUsuario();
        $this->chatService = new Chat();
    }

    public function index() {
        $this->login();
    }

    public function logar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        try{
            $usuario = $this->service->login($email, $senha);
            $this->session->setUsuario($usuario);
            $this->redirect('/welcome');
            
        } catch (ValidacaoExecao $e){
            $this->login(true);
        } catch (NoResultException $e){
            $this->login(true);
        }
    }

    public function logout() {
        $this->session->close();
        $this->chatService->logout();
        $this->redirect('/');
        
    }

    public function checkLogin() {
        return false;
    }

}

?>
