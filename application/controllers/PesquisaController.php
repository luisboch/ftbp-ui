<?php

require_once 'ftbp-src/servicos/impl/ServicoPesquisa.php';

/**
 * Description of PesquisaController
 *
 * @author luis
 */
class PesquisaController extends MY_Controller {
    /**
     *
     * @var ServicoPesquisa 
     */
    private $servico;
    
    public function __construct() {
        parent::__construct();
        $this->servico = new ServicoPesquisa();
    }
    
    
    public function pesquisar() {
        $pesquisa = $_POST['pesquisa'];
        $rs = $this->servico->pesquisar($pesquisa);
        $params = array();
        $params['resultado'] = $rs;
        $this->view('resultadoPesquisa.php', $params);
    }
    
    
}

?>
