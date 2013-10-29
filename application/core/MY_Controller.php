<?php

require_once 'ftbp-src/session/SessionManager.php';
require_once 'ftbp-src/servicos/util/Mensagens.php';

/**
 * Description of MY_Controller
 *
 * @author Luis
 */
class MY_Controller extends CI_Controller {

    /**
     * @var Logger
     */
    private static $logger;

    /**
     * @var SessionManager
     */
    protected $session;

    function __construct() {
        parent::__construct();
        
        define('URL_HOME', site_url());

        self::$logger = Logger::getLogger(__CLASS__);

        $this->session = SessionManager::getInstance();

        if ($this->checkLogin()) {
            if ($this->session->getUsuario() === null) {
                $this->login();
                exit;
            }
        }
    }

    public function login($error = false) {
        $this->view('login.php', array('error' => $error));
    }

    public function view($view, $params = array()) {

        $params['messages'] = Mensagens::getInstance()->getMsgs();
        $params['session'] = $this->session;
        $params['logado'] = $this->session->getUsuario() != null;
        $params['_usuario'] = $this->session->getUsuario();
        $params['_grupo'] = $this->session->getUsuario() != null ? $this->session->getUsuario()->getGrupo() : null;

        if ($_GET['ajax'] == 'true') {
            self::$logger->debug("[Finishing] closing ajax request, showing view \"$view\"");
            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
            // add document.
            $return .= '<document><![CDATA[' . $this->load->view($view, $params, true) . ']]></document>';

            $return .= Mensagens::getInstance()->criarXml();

            $return .= '</root>';
            header('Content-Type: text/xml; charset=utf-8');
        } else {

            self::$logger->debug("[Finishing] closing request, showing view \"$view\"");

            // Adicionando cabeçalhos
            header('Content-Type: text/html; charset=utf-8');
            header('Expires: Mon, 20 Dec 1998 01:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');

            // Inclui os usuários ativos no chat (apenas no modo de carregamento full)
            if ($this->session->getUsuario() !== null) {
                require_once 'ftbp-src/servicos/impl/ServicoChat.php';

                $chat = new Chat();
                $params['usuarios_ativos'] = $chat->carregarUsuariosAtivos();
            }

            $return = $this->load->view('cabecalho.php', $params, true);
            $return .= $this->load->view('chat.php', $params, true);
            $return .= $this->load->view('menu.php', $params, true);
            $return .= $this->load->view($view, $params, true);
            $return .= $this->load->view('rodape.php', $params, true);
        }

        echo $return;
        exit;
    }

    public function finalizarRequisicao() {
        $params['session'] = $this->session;
        $params['logado'] = $this->session->getUsuario() != null;

        if ($_GET['ajax'] == 'true') {
            self::$logger->debug("[Finishing] closing ajax request.");
            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
            // add empty document.
            $return .= '<document></document>';

            $return .= Mensagens::getInstance()->criarXml();

            $return .= '</root>';
            header('Content-Type: text/xml; charset=utf-8');
        } else {

            self::$logger->debug("[Finishing] closing request, showing view index page.");

            // Adicionando cabeçalhos
            header('Content-Type: text/html; charset=utf-8');
            header('Expires: Mon, 20 Dec 1998 01:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');

            // Inclui os usuários ativos no chat (apenas no modo de carregamento full)
            if ($this->session->getUsuario() !== null) {
                require_once 'ftbp-src/servicos/impl/ServicoChat.php';

                $chat = new Chat();
                $params['usuarios_ativos'] = $chat->carregarUsuariosAtivos();
            }

            $return = $this->load->view('cabecalho.php', $params, true);
            $return .= $this->load->view('chat.php', $params, true);
            $return .= $this->load->view('menu.php', $params, true);
            $return .= $this->load->view('index.php', $params, true);
            $return .= $this->load->view('rodape.php', $params, true);
        }

        echo $return;
        die;
    }

    public function crypt() {

        echo hash("sha512", $_GET['var']);
        exit;
    }

    /**
     * @return boolean
     */
    public function checkLogin() {
        return true;
    }

    public function redirect($action) {

        if ($_GET['ajax'] == 'true') {

            $return = '<?xml version="1.0" encoding="UTF-8"?>
                        <root>';
            if (!preg_match('#^https?://#i', $action)) {
                $return .= '<action>' . $action . '</action>';
            } else {
                $return .= '<redirect>' . $action . '</redirect>';
            }

            $return .= Mensagens::getInstance()->criarXml();

            $return .= '</root>';

            header('Content-Type: text/xml; charset=utf-8');
            echo $return;
        } else {
            redirect($action, 'location', 303);
        }

        exit;
    }

    protected function addMsg($msg, $var = '', $tipo = null) {
        Mensagens::getInstance()->addMsg($msg, $tipo);
    }

    protected function warn($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::WARN);
    }

    protected function error($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::ERROR);
    }

    protected function info($msg, $var = null) {
        $this->addMsg($msg, $var, Mensagens::INFO);
    }

    protected function carregarHome() {
        $this->redirect('welcome/index');
    }

    /**
     * @return mixed Um ou mais path's para arquivo que foi feito upload
     */
    protected function uploadArquivos() {

        $appPath = $this->getApplicationPath();

        if (!is_dir($appPath . 'uploads/')) {
            mkdir($appPath . 'uploads/', 0777, true);
        }


        if (isset($_FILES)) {
            foreach ($_FILES as $arq) {
                // Unico arquivo;
                if (isset($arq["name"])) {
                    $ext = $this->getExtension($arq['name']);
                    $fileName = 'uploads/arq_' . time() . '0.' . $ext;

                    $i = 0;
                    while (file_exists($appPath . $fileName)) {
                        $i++;
                        $fileName = 'upload_' . time() . $i . '.' . $ext;
                    }

                    if (is_writable($appPath . 'uploads/')) {

                        if (!move_uploaded_file($arq['tmp_name'], $appPath . $fileName)) {
                            throw new Exception("Falhou ao realizar o upload");
                        }
                    } else {
                        throw new Exception("Não pode escrever na pasta especificada");
                    }

                    return $fileName;
                }
            }
        }
    }

    /**
     * 
     * @param type $fileName
     */
    private function getExtension($fileName) {
        $array = explode('.', $fileName);
        return $array[count($array) - 1];
    }

    protected function getApplicationPath() {
        return dirname($_SERVER['SCRIPT_FILENAME']) . '/';
    }

    /**
     * @param int $acesso {@link GrupoAcesso}
     * @param boolean $escrita
     */
    protected function checarAcesso($acesso, $escrita = false) {
        
        // Checa se o usuário não está logado, e é alteração
        if ($this->session->getUsuario() == null && $escrita) {
            $this->bloquearAcesso();
        }

        // Se for visualização e o usuário não está logado, se for curso ou evento permite, 
        // Se não checa a permição do usuário
        else if (!$escrita &&
                (GrupoAcesso::CURSO != $acesso && GrupoAcesso::EVENTO != $acesso) &&
                $this->session->getUsuario() == null) {
            $this->bloquearAcesso();

            // Se não é escrita e o usuário está logado checa o acesso.
        } else if ($this->session->getUsuario() != null) {
            if (!$this->session->getUsuario()->getGrupo()->temAcesso($acesso, $escrita)) {
                $this->bloquearAcesso();
            }
        }
    }

    protected function bloquearAcesso() {
        $this->view('acesso_negado.php');
        die;
    }
    
    /**
     * 
     * @param Curso $curso
     * @return CursoArquivo[] Lista de arquivos disponíveis para a area.
     */
    protected function carregarArquivosDaArea(Curso $curso) {

        // Declara a variavel de retorno
        $arquivos = array();

        // Veririfica se o curso possui arquivos.
        if ($curso->getArquivos() !== null && is_array($curso->getArquivos())) {

            // Recupera o setor do usuário logado.
            if($this->session->getUsuario() == null){
                return $arquivos;
            }
            
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
