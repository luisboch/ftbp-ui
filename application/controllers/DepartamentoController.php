<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartamentoController
 *
 * @author felipe
 */
class DepartamentoController extends MY_Controller {
    
    /**
     *
     * @var ServicoDepartamento
     */
    private $servico;
    
    function __construct() {
        parent::__construct();
        $this->servico = new ServicoDepartamento();
    }

    public function index(){
        $this->view('paginas/cadastrarDepartamento.php');
    }
    
    public function salvar(){
        
        $n = new Departamento();
        $n->setNome($_POST['nome']);
        $this->servico->salvar($n);
        
    }
}

?>
