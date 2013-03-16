<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author Luis
 */
class MY_Controller extends CI_Controller{
    function __construct() {
        parent::__construct();
    }

    public function login(){
        $this->view('login.php');
    }
    public function error(){
        throw new Exception("testing error");
    }
    
    
    public function view($view, $params = array()){
        if($_GET['ajax'] == 'true'){
            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>
                            <document>';
            $return .= $this->load->view($view, $params, true);
            $return .= '</document>
                        </root>';
            
        } else {
            
            $return = $this->load->view('cabecalho.php',$params,true);
            $return .= $this->load->view('menu.php',$params,true);
            $return .= $this->load->view($view, $params, true);
            $return .= $this->load->view('rodape.php',$params,true);
        }
        
        echo $return;
        exit;
        
    }
}

?>
