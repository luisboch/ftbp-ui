<?php
require_once 'ftbp-src/servicos/impl/ServicoNotificacao.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificacaoController
 *
 * @author luis
 */
class NotificacaoController extends MY_Controller{
    /**
     *
     * @var ServicoNotificacao
     */
    private $servicoNotificao;
    
    public function __construct() {
        parent::__construct();
        $this->servicoNotificao = new ServicoNotificacao();
    }
    
    public function verMais() {
        $notfs = $this->servicoNotificao->getByUser($this->session->getUsuario());
        $this->view('notificacoes.php', array('notfs'=>$notfs));
    }
}

?>
