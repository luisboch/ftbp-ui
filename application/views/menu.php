<div id="barra_menu">
    <? if ($logado) { ?>
    <ul class="menu"> 
        <li><a href="<?= site_url('welcome/index') ?>" onclick="return carregar('welcome/index')">Home</a></li>
        <li><a href="#">Cadastrar</a> 
            <ul> 
                <li><a href="#" onclick="cadastro('cadastrarCurso', '.html');">Cursos</a></li>
                <li><a href="<?= site_url('DepartamentoController/index') ?>" onclick="return carregar('DepartamentoController/index');">Setores</a></li> 
                <li><a href="#" onclick="cadastro('cadastrarFuncionario', '.html');">Funcionários</a></li>
            </ul> 
        </li>
        <li><a href="#">Atualizações</a></li> 
        <li><a href="#">Chat</a></li>
    </ul>
    <? } ?>
    <div id="pesquisar">
        Pesquisar: <input type="text" id="pesquisa" name="pesquisa" />
        <input type="submit" value="Ok"/>
    </div>
</div>
<div id="conteudo" align="center"> 