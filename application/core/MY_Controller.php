<?php

require_once 'ftbp-src/session/SessionManager.php';
require_once 'ftbp-src/servicos/util/Mensagens.php';

/**
 * Description of MY_Controller
 *
 * @author Luis
 */
class MY_Controller extends CI_Controller {

    /**
     * @var SessionManager
     */
    protected $session;

    function __construct() {
        parent::__construct();
        $this->session = SessionManager::getInstance();

        if ($this->checkLogin()) {
            if ($this->session->getUsuario() === null) {
                $this->login();
                exit;
            }
        }
    }

    public function login() {
        $this->view('login.php');
    }

    public function view($view, $params = array()) {

        $params['messages'] = $this->messages;
        $params['session'] = $this->session;
        $params['logado'] = $this->session->getUsuario() != null;

        if ($_GET['ajax'] == 'true') {
            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
            // add document.
            $return .= '<document><![CDATA[' . $this->load->view($view, $params, true) . ']]></document>';

            $return .= Mensagens::getInstance()->criarXml();
            
            $return .= '</root>';
            header('Content-Type: text/xml; charset=utf-8');
        } else {
            header('Content-Type: text/html; charset=utf-8');

            $return = $this->load->view('cabecalho.php', $params, true);
            $return .= $this->load->view('menu.php', $params, true);
            $return .= $this->load->view($view, $params, true);
            $return .= $this->load->view('rodape.php', $params, true);
        }

        echo $return;
        exit;
    }

    public function crypt() {

        echo hash("sha512", $_GET['var']);
        exit;
    }

    /**
     * @return boolean
     */
    public function checkLogin() {
        return true;
    }

    public function redirect($action) {

        if ($_GET['ajax'] == 'true') {

            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
            if (!preg_match('#^https?://#i', $action)) {
                $return .= '<action>' . $action . '</action>';
            } else{
                $return .= '<redirect>' . $action . '</redirect>';
            }
            
            $return .= Mensagens::getInstance()->criarXml();
            
            $return .= '</root>';

            header('Content-Type: text/xml; charset=utf-8');
            echo $return;
        } else {
            redirect($action, 'location', 303);
        }

        exit;
    }

    protected function addMsg($msg, $var = '', $tipo = null) {
        Mensagens::getInstance()->addMsg($msg, $tipo);
    }
    
    protected function warn($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::WARN);
    }
    
    protected function error($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::ERROR);
    }
    
    protected function info($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::INFO);
    }

}

?>
