<?php

require_once 'ftbp-src/servicos/impl/ServicoRequisicao.php';
require_once 'ftbp-src/servicos/impl/ServicoUsuario.php';

/**
 * 
 * RequisicaoController.php
 */

/**
 * Description of RequisicaoController
 *
 * @author luis
 */
class RequisicaoController extends MY_Controller {

    /**
     * @var ServicoRequisicao
     */
    private $servico;

    /**
     * @var ServicoUsuario
     */
    private $servicoUsuario;

    function __construct() {
        parent::__construct();
        $this->servico = new ServicoRequisicao();
        $this->servicoUsuario = new ServicoUsuario();
    }

    public function index() {

        $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
        $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios));
    }

    public function verMais() {
        $this->entrada();
    }


    public function minhasRequisicoes() {
        $reqst = $this->servico->getByCriador($this->session->getUsuario());
        $this->view('paginas/requisicoes.php', array('reqst' => $reqst, 'titulo' => 'Minhas Requisições'));
    }

    public function entrada() {
        $reqst = $this->servico->getByUsuario($this->session->getUsuario());
        $this->view('paginas/requisicoes.php', array('reqst' => $reqst, 'titulo' => 'Entrada'));
    }

    /**
     * 
     * @param Requisicao|integer $rq
     */
    public function ver($rq = null) {

        if ($rq === null || !$rq instanceof Requisicao) {
            $id = $this->uri->segment(3);
            $rq = $this->servico->getById($id);
        }

        $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();

        $this->view('paginas/verRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
    }

    public function salvar() {

        // Verifica se é salvamento ou atualização.
        if ($_POST['id'] == '') {
            $rq = new Requisicao();
            $rq->setCriadoPor($this->session->getUsuario());
        } else {
            $rq = $this->servico->getById($_POST['id']);
        }

        // Atualiza os valores.
        $rq->setDescricao($_POST['descricao']);
        $rq->setTitulo($_POST['titulo']);
        $rq->setPrioridade($_POST['prioridade']);
        $rq->setStatus($_POST['status']);

        // Valida o usuário
        if ($_POST['usuario_id'] == '') {
            $this->warn("Usuário inválido.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }

        // Recupera o usuário
        try {
            $usuarioAlvo = $this->servicoUsuario->getById($_POST['usuario_id']);
            $rq->setUsuario($usuarioAlvo);
        } catch (Exception $e) {
            $this->warn("Usuário inválido.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }

        // Salva
        try {

            if ($rq->getId() == '') {
                $this->servico->inserir($rq);
                $this->warn("Requisição enviada com sucesso.");
            } else {
                $this->servico->atualizar($rq);
                $this->warn("Requisição atualizada com sucesso.");
            }

            $this->carregarHome();
        } catch (ValidacaoExecao $e) {
            foreach ($e->getErrors() as $err) {
                $this->warn($err->getMensagem(), $err->getCampo());
            }
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        } catch (Exception $e) {
            $this->error("Falha ao cadastrar a requisição.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }
    }

    public function salvarIteracao() {

        // Verifica se é salvamento ou atualização.
        if ($_POST['id'] == '') {
            throw new IllegalStateException("Esperado id da requisição, nada encontrado");
        } else {
            $rq = $this->servico->getById($_POST['id']);
        }

        // Atualiza os valores.
        $rq->setPrioridade($_POST['prioridade']);
        $rq->setStatus($_POST['status']);

        // Valida o usuário
        if ($_POST['usuario_id'] == '') {
            $this->warn("Usuário inválido.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }

        // Recupera o usuário
        try {
            $usuarioAlvo = $this->servicoUsuario->getById($_POST['usuario_id']);
            $rq->setUsuario($usuarioAlvo);
        } catch (Exception $e) {
            $this->warn("Usuário inválido.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }

        // Verifica se há uma nova mensagem
        if ($_POST['mensagem'] != '') {
            $mensagem = $_POST['mensagem'];
            $it = new RequisicaoIteracao();
            $it->setMensagem($mensagem);
            $it->setUsuario($this->session->getUsuario());
            $it->setDataCriacao(new DateTime());
            $it->setRequisicao($rq);
            $rq->addIteracao($it);
        }

        // Salva
        try {
            $this->servico->atualizar($rq);
            $this->warn("Requisição atualizada com sucesso.");
            $this->carregarHome();
        } catch (ValidacaoExecao $e) {
            foreach ($e->getErrors() as $err) {
                $this->warn($err->getMensagem(), $err->getCampo());
            }
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        } catch (Exception $e) {
            $this->error("Falha ao cadastrar a requisição.");
            $usuarios = $this->servicoUsuario->carregarTodosOsUsuarios();
            $this->view('paginas/cadastrarRequisicao.php', array('usuarios' => $usuarios, 'requisicao' => $rq));
        }
    }

}

?>
