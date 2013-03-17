<?php
require_once 'ftbp-src/servicos/impl/ServicoDepartamento.php';

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
        $this->servico->inserir($n);
        
    }
}

?>
