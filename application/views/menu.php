<div id="barra_menu">
    <? if ($logado) { ?>
        <ul class="menu"> 
            <li><a href="<?= site_url('welcome/index') ?>" onclick="return carregar('welcome/index', null, true)">Home</a></li>
            <li><a href="#" onclick="return false;">Cadastrar</a> 
                <ul> 
                    <li><a href="<?= site_url('CursoController/index') ?>" onclick="return carregar('CursoController/index', null, true);">Cursos</a></li>
                    <li><a href="<?= site_url('AvisoController/index') ?>" onclick="return carregar('AvisoController/index', null, true);">Avisos</a></li> 
                    <li><a href="<?= site_url('DepartamentoController/index') ?>" onclick="return carregar('DepartamentoController/index', null, true);">Setores</a></li> 
                    <li><a href="<?= site_url('AreaController/index') ?>" onclick="return carregar('AreaController/index', null, true);">Cursos Areas</a></li> 
                    <li><a href="<?= site_url('UsuariosController/index') ?>" onclick="return carregar('UsuariosController/index', null, true);">Funcionários</a></li>
                    <li><a href="<?= site_url('RequisicaoController/index') ?>" onclick="return carregar('RequisicaoController/index', null, true);">Requisições</a></li>
                </ul> 
            </li>
            <li><a href="#" onclick="return false;">Meus Itens</a>
                <ul>
                    <li><a href="<?=site_url('AvisoController/verMais')?>" onclick="return carregar('AvisoController/verMais', null, true);">Avisos</a></li> 
                    <li><a href="<?=site_url('NotificacaoController/verMais')?>" onclick="return carregar('NotificacaoController/verMais', null, true);">Notificações</a></li>
                    <li><a href="" onclick="">Requisições</a></li>
                </ul>
            </li>
            <!--<li><a href="#">Chat</a></li>-->
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