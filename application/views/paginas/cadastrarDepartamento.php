<form method="post" id="form-cadastro" action="<?= site_url('DepartamentoController/salvar') ?>" onsubmit="return carregar('DepartamentoController/salvar', $('#form-cadastro').serialize())">
    <input type="hidden" id="id" name="id" value="<?= empty($departamento) ? '' : $departamento->getId(); ?>" />
    <table class="form-table">
        <caption><span>Cadastro de Setores</span></caption>
        <tbody>
            <tr>
                <td>Nome do Setor</td>
                <td><input id="nome" name="nome"  type="text" value="<?= empty($departamento) ? '' : $departamento->getNome(); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::SETOR, true)) { ?>
                        <input type="submit" value="<?= empty($departamento) ? 'Cadastrar' : 'Salvar'; ?>">
                    <? } ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>