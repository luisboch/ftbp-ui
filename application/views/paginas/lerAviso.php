<style type="text/css">
    .form-table-aviso tr td:first-child{
        text-align: right;
        
    }

    .form-table-aviso tr td:last-child{
        text-align: left;
        font-weight: bold;
    }
    
</style>

<table border="0" class="form-table-aviso">

    <caption><span>Aviso</span></caption>
    <tbody >
        <tr>
            <td>Criado por: </td>
            <td>
                <?= $aviso->getCriadoPor()->getNome() ?>
            </td>
        </tr>
        <tr>
            <td>Data Criação: </td>
            <td>
                <?= $aviso->getDataCriacao()->format('d/M/y') ?>
            </td>
        </tr>
        <tr>
            <td>Titulo: </td>
            <td>
                <?= $aviso->getTitulo() ?>
            </td>
        </tr>
        <tr>
            <td>Descrição: </td>
            <td>
                <textarea rows="4" cols="50" readonly="true" ><?= $aviso->getDescricao() ?></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="button" value="Voltar" onclick="javascript:window.history.go(-1);location.reload(true);">
            </td>
        </tr>
    </tbody>
</table>


