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
        $this->load->view('basic/login.php');
    }
    public function error(){
        throw new Exception("testing error");
    }
}

?>
