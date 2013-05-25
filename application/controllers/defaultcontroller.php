<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DefaultController extends MY_Controller {
    
    /**
     *
     * @var ServicoCurso
     */
    private $servicoCurso;
    
    function __construct() {
        parent::__construct();
        $this->servicoCurso = new ServicoCurso();
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
        $this->view('index_ext.php', array('cursos'=>$cursos));
        
    }
    
    public function checkLogin() {
        return false;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
