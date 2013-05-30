
<input type="hidden" name="id" id="id" value="<?= empty($evento) ? '' : $evento->getId(); ?>" /> 
<table border="0" class="form-table">

    <caption><span>Evento</span></caption>
    <tbody >
        <tr>
            <td>Titulo</td>
            <td>
                <?= $evento->getTitulo(); ?>
            </td>
        </tr>
        <tr>
            <td>Descrição: </td>
            <td>
                <textarea rows="7" cols="50" id="descricao" name="descricao" readonly="readonly" ><?= $evento->getDescricao(); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Data</td>
            <td>
                <?= empty($evento) || $evento->getDataEvento() == null ? '' : $evento->getDataEvento()->format('d/m/Y'); ?>
            </td>
        </tr>
        <tr>
            <td>Local</td>
            <td>
                <?= $evento->getLocal(); ?>
            </td>
        </tr>
        <tr>
            <td>Contato</td>
            <td>
                <?= $evento->getContato(); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Voltar"onclick="javascript:window.history.go(-1);
                        location.reload(true);" />
                
                <? if ($logado && $_grupo != null && $_grupo->temAcesso(GrupoAcesso::EVENTO, true)) { ?>
                    <input type="submit" value="Editar"onclick="return carregar('EventoController/alterarEvento/<?= $evento->getId(); ?>', null, true);" />
                <? } ?>
            </td>
        </tr>   
    </tbody>
</table>


