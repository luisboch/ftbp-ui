<?php

require_once 'ftbp-src/session/SessionManager.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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

    public function error() {
        throw new Exception("testing error");
    }

    public function view($view, $params = array()) {

        $params['session'] = $this->session;
        $params['logado'] = $this->session->getUsuario() != null;

        if ($_GET['ajax'] == 'true') {
            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>
                            <document><![CDATA[';
            $return .= $this->load->view($view, $params, true);
            $return .= ']]></document>
                        </root>';
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
        redirect($action, 'location', 303);
        exit;
    }

}

?>
