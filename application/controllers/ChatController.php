<?php
require_once 'ftbp-src/servicos/impl/ServicoChat.php';
/*
 * ChatController.php
 */

/**
 * Description of Chat
 *
 * @author Luis
 * @since Mar 24, 2013
 */
class ChatController extends MY_Controller {
    
    private $chat;
    /**
     *
     * @var array
     */
    private $params;
    
    public function __construct() {
        parent::__construct();
        $this->chat = new Chat();
    }
    public function index() {
        
    }
    public function u() {
        $this->load->view('usuario_chat.php');
    }
    
    public function toogleChat() {
        $this->session->setShowChat(!$this->session->getShowChat());
        $this->finalizarRequisicao();
    }
    
    public function atualizarChat() {
        
        $usuarios = $this->chat->carregarUsuariosAtivos();
        
        $this->params['usuarios'] = array();
        $i = 0;
        foreach($usuarios as $u){
            
            $arr = array();
            
            $arr['nome'] = $u->getNome();
            $arr['id'] = $u->getId();
            $arr['departamento'] = $u->getDepartamento() === null? '':$u->getDepartamento()->getNome();
            
            $this->params['usuarios']['usr_'.$i] = $arr;
            $i++;
        }
        
        $this->montarXml();
    }
    
    public function montarXml() {
        $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
        // add document.
        $return .= '<document></document>';

        $return .= Mensagens::getInstance()->criarXml();
        $return .= $this->carregarParametros();
        $return .= '</root>';
        header('Content-Type: text/xml; charset=utf-8');
        echo $return;
        exit;
    }
    public function carregarParametros($arr = NULL) {
        if($arr === null){
            $arr = $this->params;
        }
        $return = "";
        foreach($arr as $k => $v){
            if(is_array($v)){
                $return .= '<'.$k.'>'.$this->carregarParametros($v).'</'.$k.'>';
            } else{
                $return .= '<'.$k.'>'.$v.'</'.$k.'>';
            }
        }
        return $return;
    }
}

?>