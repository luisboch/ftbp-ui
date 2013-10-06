<? /* @var $evento Evento */ ?>
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
            <td><?= $evento->getDescricao(); ?></td>
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
                <?= $evento->getContato() == null?'':$evento->getContato()->getNome(); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Voltar"onclick="return goBack();" />
                
                <? if ($logado && $_grupo != null && $_grupo->temAcesso(GrupoAcesso::EVENTO, true)) { ?>
                    <input type="submit" value="Editar"onclick="return carregar('EventoController/alterarEvento/<?= $evento->getId(); ?>', null, true);" />
                <? } ?>
            </td>
        </tr>   
    </tbody>
</table>


