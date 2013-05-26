<form method="post" id="form-cadastro" action="<?=site_url('GrupoController/salvar')?>" onsubmit="return carregar('GrupoController/salvar', $('#form-cadastro').serialize())">
    <input type="hidden" id="id" name="id" value="<?=empty($grupo)?'':$grupo->getId();?>" />
    <table class="form-table">
        <caption><span>Cadastro de Grupos</span></caption>
        <tbody>
            <tr>
                <td>Nome do Grupo</td>
                <td><input id="nome" name="nome"  type="text" value="<?=empty($grupo)?'':$grupo->getNome();?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?=empty($grupo)?'Cadastrar':'Salvar';?>"></td>
            </tr>
        </tbody>
    </table>
</form>