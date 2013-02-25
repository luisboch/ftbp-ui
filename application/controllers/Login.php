<?php
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
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

    function __construct() {
        parent::__construct();
        $this->service = new ServicoUsuario();
    }

    public function logar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        echo 'logou com: '.$this->service->login($email, $senha);
        exit;
    }

}

?>
