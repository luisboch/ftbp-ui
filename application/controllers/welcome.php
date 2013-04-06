<?php

require_once 'ftbp-src/servicos/impl/ServicoNotificacao.php';
require_once 'ftbp-src/servicos/impl/ServicoAviso.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {
    
    /**
     *
     * @var ServicoNotificacao
     */
    private $servicoNotificacao;
    private $servicoAviso;

    function __construct() {
        parent::__construct();
        $this->servicoNotificacao = new ServicoNotificacao();
        $this->servicoAviso = new ServicoAviso();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        
        $list = $this->servicoNotificacao->carregarUltimasNotificacoes($this->session->getUsuario());
        $listAviso = $this->servicoAviso->carregarUltimosAvisos($this->session->getUsuario());
        
        $this->view('index.php', array('notfs'=>$list, 'aviso' =>$listAviso));
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */