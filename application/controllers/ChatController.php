<?php

/*
 * Chat.php
 */

/**
 * Description of Chat
 *
 * @author Luis
 * @since Mar 24, 2013
 */
class ChatController extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        echo 'aaaaaaaaaaaaaaaaaaa';
    }
    public function u() {
        $this->load->view('usuario_chat.php');
    }
}

?>
