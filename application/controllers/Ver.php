<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';
require_once 'ftbp-src/servicos/impl/ServicoEvento.php';

/**
 * Description of Ver
 *
 * @author luis
 */
class Ver extends MY_Controller {

    /**
     * @var ServicoEvento
     */
    private $servicoEvento;

    /**
     *
     * @var ServicoCurso
     */
    private $servicoCurso;

    function __construct() {
        parent::__construct();

        // Cria os servicos
        $this->servicoEvento = new ServicoEvento();
        $this->servicoCurso = new ServicoCurso();
    }

    public function checkLogin() {
        return false;
    }

    public function curso() {
        $this->checarAcesso(GrupoAcesso::CURSO, false);

        // Pega o id da visualização.
        $id = $this->uri->segment(3);

        try {
            // Recupera o dado do banco de dados.
            $cr = $this->servicoCurso->getById($id);

            // Redireciona para a página de visualização.
            $this->view('paginas/verCurso.php', array('curso' => $cr));
        } catch (NoResultException $ex) {

            $this->error("Curso não encontrado");
            $this->index();
        }
    }

    public function evento() {
        
        $this->checarAcesso(GrupoAcesso::EVENTO, false);
        
        // Pega o id da visualização.
        $id = $this->uri->segment(3);

        try {
            
            // Recupera o dado do banco de dados.
            $ev = $this->servicoEvento->getById($id);

            // Redireciona para a página de visualização.
            $this->view('paginas/verEvento.php', array('evento' => $ev));
            
        } catch (NoResultException $ex) {
            $this->error("Evento não encontrado");
            $this->index();
        }
    }

}

?>
