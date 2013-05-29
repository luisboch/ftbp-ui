<?php

require_once 'ftbp-src/servicos/impl/ServicoCurso.php';
require_once 'ftbp-src/servicos/impl/ServicoArea.php';
require_once 'ftbp-src/entidades/basico/AreaCurso.php';

/**
 * Description of AvisoController
 *
 * @author felipe
 */
class CursoController extends MY_Controller {

    /**
     *
     * @var ServicoCurso
     */
    private $servico;

    /**
     *
     * @var ServicoArea 
     */
    private $servicoArea;

    /**
     *
     * @var ServicoUsuario 
     */
    function __construct() {
        parent::__construct();
        $this->servico = new ServicoCurso();
        $this->servicoArea = new ServicoArea();
    }

    public function index() {
        $areaCurso = $this->servicoArea->carregarArea();
        $this->view('paginas/cadastrarCurso.php', array('area' => $areaCurso, 'arquivos' => array()));
    }

    public function salvar() {
        // Recupera o id que veio do form.
        $id = $_POST['id'];
        // Inicia bloco de controle
        try {
            // Se estiver vazio é novo.
            if ($id == '') {
                $n = new Curso();
            } else {
                
                /**
                 * É obrigatório o carregamento do banco de dados, pois, quando
                 * encaminhamos para a view, carregamos apenas os arquivos 
                 * associados à setor/departamento do usuário, logo quando ele 
                 * salvar precisamos recarregar completamente o objeto do banco,
                 * para que ao chamar o dao, os arquivos cadastrados em outro
                 * setor sejam mantidos, isso é necessário pois o dao, exclui 
                 * todos os arquivos e salva novamente. Adicionalmente e não 
                 * menos importante validamos se o curso existe no banco de 
                 * dados antes de tentar atualizar algo que não foi cadastradou,
                 * ou foi deletado.
                 */
                
                $n = $this->servico->getById($id);
            }
        } catch (NoResultException $e) {
            // Se não encontrar exibe 404
            show_404();
            
            exit;
        }

        // Inicia bloco de controle
        try {

            // Seta os novos valores

            $n->setNome($_POST['nome']);
            $n->setDescricao($_POST['descricao']);

            if ($_POST['areaCurso'] != '') {
                $area = $this->servicoArea->getById($_POST['areaCurso']);
                $n->setAreaCurso($area);
            }

            $n->setContatoSecretaria($_POST['contatoSecretaria']);
            $n->setCoordenador($_POST['coordenador']);
            $n->setCorpoDocente($_POST["corpoDocente"]);
            $dt = DateTime::createFromFormat('d/m/Y', $_POST["dataVestibular"]);
            $n->setDataVestibular($dt);
            $n->setDescricao($_POST['descricao']);
            
            // Trata o valor (retirando a vírgula)
            if ($_POST['valor'] != '') {
                $duracao = str_replace(',', '.', $_POST['duracao']);
                $n->setDuracao($duracao);
            }

            $n->setNivelGraduacao($_POST['nivelGraduacao']);
            $n->setPublicoAlvo($_POST['publicoAlvo']);

            // Trata o valor (retirando a vírgula)
            if ($_POST['valor'] != '') {
                $valor = str_replace(',', '.', $_POST['valor']);
                $n->setValor($valor);
            }

            $n->setVideoApresentacao($_POST['videoApresentacao']);
            $n->setEmail($_POST['email']);
            $n->setCredito($_POST['credito']);

            // Verifica se há arquivo para upload
            if (isset($_FILES['arquivo']) && isset($_FILES['arquivo']['name']) &&
                    $_FILES['arquivo']['name'] != null) {
                $caminho = $this->uploadArquivos();
                $descricao = $_POST['arq_desc'];
                $arq = new CursoArquivo();
                $arq->setUsuario($this->session->getUsuario());
                $arq->setCaminho($caminho);
                $arq->setCurso($n);
                $arq->setSetor($this->session->getUsuario()->getDepartamento());
                $arq->setDescricao($descricao);
                $n->adicionarArquivo($arq);
            }

            // Chama o salvar, (atualiza ou insere)
            if ($id == '') {
                $this->servico->inserir($n);
            } else {
                $this->servico->atualizar($n);
            }

            // direciona para a view correta, e adiciona uma mensagem de feed back.
            $this->info("Curso " . ($id == '' ? 'cadastrado' : 'atualizado') . " com sucesso");

            $areaCurso = $this->servicoArea->carregarArea();

            // Carrega os arquivos do curso
            $arquivos = $this->carregarArquivosDaArea($n);

            $this->view('paginas/cadastrarCurso.php', array('curso' => $n, 'area' => $areaCurso, 'arquivos' => $arquivos));
        } catch (ValidacaoExecao $e) {

            // Exibe os erros encontrados
            foreach ($e->getErrors() as $v) {
                $this->warn($v->getMensagem(), $v->getCampo());
            }

            // Carrega os arquivos do curso
            $arquivos = $this->carregarArquivosDaArea($n);

            // Encaminha para a view de edição
            $this->view('paginas/cadastrarCurso.php', array('curso' => $n, 'arquivos' => $arquivos));
        }
    }

    public function verCurso() {

        $id = $this->uri->segment(3);

        try {
            $cr = $this->servico->getById($id);
            $this->view('paginas/verCurso.php', array('curso' => $cr));
        } catch (NoResultException $ex) {
            $this->error("Curso não encontrado");
            $this->index();
        }
    }

    public function verMais() {
        $cr = $this->servico->carregarCurso();
        $this->view('paginas/curso.php', array('titulo' => 'Cursos', 'curso' => $cr));
    }

    public function alterarCurso() {
        try {
            $id = $this->uri->segment(3);
            $cr = $this->servico->getById($id);
            $areaCurso = $this->servicoArea->carregarArea();

            // Carrega os arquivos do curso
            $arquivos = $this->carregarArquivosDaArea($cr);

            // Encaminha para a view de edição
            $this->view('paginas/cadastrarCurso.php', array('area' => $areaCurso, 'curso' => $cr, 'arquivos' => $arquivos));
        } catch (NoResultException $ex) {
            $this->error("Curso não encontrado");
            $this->index();
        }
    }

    public function excluirArquivo() {
        // Carrega as variaveis da requisição.
        $cursoId = $_POST['curso'];
        $usuarioId = $_POST['usuario'];
        $departamento_id = $_POST['departamento'];
        $msg = $_POST['mensagem'];

        // Carrega as áreas (usadas apenas na view).
        $areas = $this->servicoArea->carregarArea();

        $curso = new Curso();

        try {
            // Carrega o curso
            $curso = $this->servico->getById($cursoId);

            $cursoArquivo = null;

            // Encontra o arquivo.
            foreach ($curso->getArquivos() as $arq) {
                if ($arq->getUsuario()->getId() == $usuarioId && $arq->getSetor()->getId() == $departamento_id && $arq->getDescricao() == $msg) {
                    $cursoArquivo = $arq;
                    break;
                }
            }

            // Se encontrou o arquivo.
            if ($cursoArquivo != null) {
                // Remove do curso
                $curso->removerArquivo($arq);

                // Deleta o arquivo em disco
                unlink($this->getApplicationPath() . $cursoArquivo->getCaminho());

                // Salva o curso
                $this->servico->atualizar($curso);

                // Adiciona mensagem de sucesso.
                $this->info("Arquivo excluido com sucesso");
            } else {
                // Adiciona mensagem de erro.
                $this->info("Arquivo para exclusão não encontrado");
            }

            // Carrega os arquivos do curso
            $arquivos = $this->carregarArquivosDaArea($n);
            
            // Carrega a view.
            $this->view('paginas/cadastrarCurso.php', array('area' => $areas, 
                'curso' => $curso, 'arquivos' => $arquivos));
        } catch (Exception $ex) {
            $this->error("Ops, encontramos um problema ao excluir o arquivo");
            $this->view('paginas/cadastrarCurso.php', array('area' => $areas, 'curso' => $curso));
        }
    }

    /**
     * 
     * @param Curso $curso
     * @return CursoArquivo[] Lista de arquivos disponíveis para a area.
     */
    function carregarArquivosDaArea(Curso $curso) {

        // Declara a variavel de retorno
        $arquivos = array();

        // Veririfica se o curso possui arquivos.
        if ($curso->getArquivos() !== null && is_array($curso->getArquivos())) {

            // Recupera o setor do usuário logado.
            $setor = $this->session->getUsuario()->getDepartamento();

            // Verifica o usuário tem um setor
            if ($setor != null) {

                // Percorre a lista de setores 
                foreach ($curso->getArquivos() as $arc) {

                    // Verifica qual pertence ao setor do usuário
                    if ($arc->getSetor()->getId() === $setor->getId()) {

                        // Adiciona à lista de retorno.
                        $arquivos[] = $arc;
                    }
                }
            }
        }

        return $arquivos;
    }

}

?>
