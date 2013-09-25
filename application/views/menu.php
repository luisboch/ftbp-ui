<? /* @var $session SessionManager */ ?>
<div id="barra_menu">
    <? if ($logado) { ?>
        <ul class="menu"> 
            <li><a href="<?= site_url('welcome/index') ?>" onclick="return carregar('welcome/index', null, true)">Home</a></li>
            <li><a href="#" onclick="return false;">Administração</a> 
                <ul> 

                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::AVISO, true)) { ?>
                        <li><a href="<?= site_url('AvisoController/index') ?>" onclick="return carregar('AvisoController/index', null, true);">Avisos</a></li> 
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::CURSO, true)) { ?>
                        <li><a href="<?= site_url('CursoController/index') ?>" onclick="return carregar('CursoController/index', null, true);">Cursos</a></li>
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::CURSO_AREA, true)) { ?>
                        <li><a href="<?= site_url('AreaController/index') ?>" onclick="return carregar('AreaController/index', null, true);">Cursos Areas</a></li> 
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::EVENTO, true)) { ?>
                        <li><a href="<?= site_url('EventoController/index') ?>" onclick="return carregar('EventoController/index', null, true);">Eventos</a></li>
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::USUARIO, false)) { ?>
                        <li><a href="<?= site_url('UsuariosController/index') ?>" onclick="return carregar('UsuariosController/index', null, true);">Usuários</a>
                            <ul>
                                <li><a href="<?= site_url('UsuariosController/index') ?>" onclick="return carregar('UsuariosController/index', null, true);">Novo</a></li>
                                <li><a href="<?= site_url('UsuariosController/pesquisar') ?>" onclick="return carregar('UsuariosController/index', null, true);">Pesquisar</a></li>
                            </ul>
                        </li>
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::REQUISICAO, true)) { ?>
                        <li><a href="<?= site_url('RequisicaoController/index') ?>" onclick="return carregar('RequisicaoController/index', null, true);">Requisições</a></li>
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::SETOR, true)) { ?>
                        <li><a href="<?= site_url('DepartamentoController/index') ?>" onclick="return carregar('DepartamentoController/index', null, true);">Setores</a></li> 
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::GRUPO_DE_USUARIO, true)) { ?>
                        <li><a href="<?= site_url('GrupoController/index') ?>" onclick="return carregar('GrupoController/index', null, true);">Grupos de usuários</a></li> 
                    <? } ?>

                </ul> 
            </li>
            <li><a href="#" onclick="return false;">Meus Itens</a>
                <ul>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::AVISO)) { ?>
                        <li><a href="<?= site_url('AvisoController/verMais') ?>" onclick="return carregar('AvisoController/verMais', null, true);">Avisos</a></li> 
                    <? } ?>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::EVENTO)) { ?>
                        <li><a href="<?= site_url('EventoController/verMais') ?>" onclick="return carregar('EventoController/verMais', null, true);">Eventos</a></li>
                    <? } ?>
                    <li><a href="<?= site_url('NotificacaoController/verMais') ?>" onclick="return carregar('NotificacaoController/verMais', null, true);">Notificações</a></li>
                    <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::REQUISICAO)) { ?>
                        <li><a href="<?= site_url('RequisicaoController/verMais') ?>" onclick="return carregar('RequisicaoController/verMais', null, true);">Requisições</a></li>
                    <? } ?>

                </ul>
            </li>
            <? if ($session->getUsuario()->getGrupo()->temAcesso(GrupoAcesso::RELATORIOS)) { ?>
                <li><a href="#" onclick="return false;">Relatórios</a>
                    <ul>
                        <li><a href="<?= site_url('RelatorioCursoController/index') ?>" onclick="return carregar('RelatorioCursoController/index', null, true);" >Curso</a></li>
                        <li><a href="<?= site_url('RelatorioRequisicaoController/index') ?>" onclick="return carregar('RelatorioRequisicaoController/index', null, true);" >Requisições</a></li>
                    </ul>
                </li>
            <? } ?>

        </ul>
    <? } else { ?>
        <ul class="menu"> 
            <li><a href="<?= site_url('') ?>" onclick="return carregar('', null, true)">Home</a></li>
        </ul>
    <? } ?>
    <div id="pesquisar">
        <form id="form-pesquisa" action="<?= site_url('PesquisaController/pesquisar') ?>" 
              method="post" onsubmit="return carregar('PesquisaController/pesquisar', $('#form-pesquisa').serialize())">
            Pesquisar: <input type="text" id="pesquisa" name="pesquisa" />
            <input type="submit" value="Ok"/>
        </form>
    </div>
</div>
<div id="conteudo" align="center"> 
