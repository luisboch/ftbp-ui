<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';
require_once 'ftbp-src/servicos/impl/ServicoEvento.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DefaultController extends MY_Controller {

    /**
     *
     * @var ServicoCurso
     */
    private $servicoCurso;

    /**
     *
     * @var ServicoEvento
     */
    private $servicoEvento;

    function __construct() {
        parent::__construct();

        $this->servicoCurso = new ServicoCurso();
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
        $cursos = $this->servicoCurso->carregarCurso(10);
        $eventos = $this->servicoEvento->carregarEvento(10);
        $this->view('index_ext.php', array('cursos' => $cursos, 'eventos' => $eventos));
    }

    public function checkLogin() {
        return false;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
