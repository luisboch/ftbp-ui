<div id="barra_menu">
    <? if ($logado) { ?>
        <ul class="menu"> 
            <li><a href="<?= site_url('welcome/index') ?>" onclick="return carregar('welcome/index')">Home</a></li>
            <li><a href="#">Cadastrar</a> 
                <ul> 
                    <li><a href="#" onclick="cadastro('cadastrarCurso', '.html');">Cursos</a></li>
                    <li><a href="<?= site_url('DepartamentoController/index') ?>" onclick="return carregar('DepartamentoController/index');">Setores</a></li> 
                    <li><a href="<?= site_url('AreaController/index') ?>" onclick="return carregar('AreaController/index');">Cursos Areas</a></li> 
                    <li><a href="<?= site_url('UsuariosController/index') ?>" onclick="return carregar('UsuariosController/index');">Funcionários</a></li>
                </ul> 
            </li>
            <li><a href="#">Atualizações</a></li> 
            <li><a href="#">Chat</a></li>
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