<?php

require_once 'ftbp-src/servicos/impl/ServicoNotificacao.php';
require_once 'ftbp-src/servicos/impl/ServicoAviso.php';
require_once 'ftbp-src/servicos/impl/ServicoRequisicao.php';
require_once 'ftbp-src/servicos/impl/ServicoEvento.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {
    
    /**
     *
     * @var ServicoNotificacao
     */
    private $servicoNotificacao;
    
    /**
     *
     * @var ServicoAviso
     */
    private $servicoAviso;

    /**
     *
     * @var ServicoRequisicao
     */
    private $servicoRequisicao;
    
    /**
     *
     * @var ServicoEvento
     */
    private $servicoEvento;
    
    function __construct() {
        parent::__construct();
        $this->servicoNotificacao = new ServicoNotificacao();
        $this->servicoAviso = new ServicoAviso();
        $this->servicoRequisicao = new ServicoRequisicao();
        $this->servicoEvento = new ServicoEvento();
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
        
        $listRequisicao = $this->servicoRequisicao->carregarUltimasRequisicoes($this->session->getUsuario());
        $eventos = $this->servicoEvento->carregarEvento(10);
        
        $this->view('index.php', array('notfs'=>$list, 'aviso' =>$listAviso, 'reqst' => $listRequisicao, 'eventos' => $eventos));
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */