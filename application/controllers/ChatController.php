<?php
require_once 'ftbp-src/servicos/impl/ServicoChat.php';
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';
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
    private $servicoUsuario;
    private $chat;
    /**
     *
     * @var array
     */
    private $params;
    
    public function __construct() {
        parent::__construct();
        $this->chat = new Chat();
        $this->servicoUsuario = new ServicoUsuario();
    }
    public function index() {
        
    }
    public function u() {
        $id = $this->uri->segment(3);
        $alvo = $this->servicoUsuario->getById($id);
        $msgs = $this->chat->carregarMensagens($this->session->getUsuario(), $alvo);
        $this->load->view('usuario_chat.php', array('alvo' => $alvo, 'mensagens' => $msgs));
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
            $arr['com_mgs'] = $this->chat->existeMensagem($this->session->getUsuario(), $u)?'true':'false';
            $this->params['usuarios']['usr_'.$i] = $arr;
            $i++;
        }
        
        $this->montarXml();
        exit;
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
    
    public function enviarMensagem() {
        $usuarioAlvo = $_POST['usr_id'];
        $msg = $_POST['mensagem'];
        $usuarioAlvo = $this->servicoUsuario->getById($usuarioAlvo);
        $this->chat->enviarMensagem($this->session->getUsuario(), $usuarioAlvo, $msg);
        $this->params['sucesso'] = true;
        $this->montarXml();
    }
    
    public function atualizarMensagens() {
        
        $usrId = $_POST['usr_id'];
        
        $usuarioAlvo = $this->servicoUsuario->getById($usrId);
        
        $mensagens = $this->chat->carregarMensagens($this->session->getUsuario(), $usuarioAlvo);
        $this->params['mensagens'] = array();
        foreach($mensagens as $k => $v){
            $this->params['mensagens']['msg_'.$k] = array();
            $this->params['mensagens']['msg_'.$k]['nome'] = $v->getUsuario()->getNome();
            $this->params['mensagens']['msg_'.$k]['mensagem'] = $v->getMensagem();
            $this->params['mensagens']['msg_'.$k]['lido'] = $v->isRead()?'true':'false';
            $this->params['mensagens']['msg_'.$k]['data'] = $v->getData()->format('d/m H:i:s');
        }
        
        $this->montarXml();
    }
}

?>