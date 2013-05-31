<? /* @var $_grupo Grupo */ ?>
<form method="post" id="form-cadastro" action="<?= site_url('AreaController/salvar') ?>" onsubmit="return carregar('AreaController/salvar', $('#form-cadastro').serialize())">
    <input type="hidden" id="id" name="id" value="<?= empty($area) ? '' : $area->getId(); ?>" />
    <table class="form-table">
        <caption><span>Cadastro de Areas</span></caption>
        <tbody>
            <tr>
                <td>Nome da Area</td>
                <td><input id="nome" name="nome"  type="text" value="<?= empty($area) ? '' : $area->getNome(); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::CURSO_AREA, true)) { ?>
                        <input type="submit" value="<?= empty($area) ? 'Cadastrar' : 'Salvar'; ?>">
                    <? } ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>