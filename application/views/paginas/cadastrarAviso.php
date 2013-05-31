<? /* @var $_grupo Grupo */ ?>

<script>

    $("#setor_resp").click(function() {
        if ($(this).is(':checked')) {
            $("#setor_resp_check").css('display', 'block');
        }
        else {
            $("#setor_resp_check").css('display', 'none');
        }
    });

    $("#setor_usuarios").click(function() {
        if ($(this).is(':checked')) {
            $("#setor_usu_check").css('display', 'block');
        }
        else {
            $("#setor_usu_check").css('display', 'none');
        }
    });

    $("#usuario").click(function() {
        if ($(this).is(':checked')) {
            $("#usuario_check").css('display', 'block');
        }
        else {
            $("#usuario_check").css('display', 'none');
        }
    });

    function confirmacao() {
        return confirm("Aviso não podera ser alterado após envio. Confirma operação: ");
    }
</script>

<form id="form-cadastro" action="<?= site_url('AvisoController/salvar'); ?>" 
      onsubmit="return carregar('AvisoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <!--<input type="hidden" name="id" id="id" value="<?= empty($aviso) ? '' : $aviso->getId(); ?>" /> -->
    <table border="0" class="form-table">

        <caption><span>Cadastrar Aviso</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value=""/>
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" id="descricao" name="descricao" value=""></textarea>
                </td>
            </tr>
            <tr>
                <td>Destino: </td>
                <td><input type="checkbox" name="todos"/>Todos</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="setor_resp"  id="setor_resp"/>Responsaveis por Setor
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="setor_resp_check" multiple="multiple" name="setor_resp_check[]" style="display: none">
                        <?
                        foreach ($dptos as $v) {
                            ?>
                            <option value ="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>

                            <?
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="setor_usuarios"  id="setor_usuarios"/>Usuarios por Setor
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="setor_usu_check" multiple="multiple" name="setor_usu_check[]" style="display: none">

                        <?
                        foreach ($dptos as $v) {
                            ?>
                            <option value ="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>

                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="usuario" id="usuario"/>Funcionario
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="usuario_check" name="usuario_check[]" multiple="multiple" style="display: none">
                        <?
                        foreach ($usuarios as $v) {
                            ?>
                            <option value ="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>

                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::AVISO, true)) { ?>
                        <input type="submit" value="Salvar" 
                               onClick="return confirmacao();"/>
                    <? } ?>
                </td>
            </tr>   
        </tbody>
    </table>
</form>

