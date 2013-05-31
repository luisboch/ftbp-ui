<style  type="text/css">

    table{
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size:1.2em;
        width:500px;
        border-collapse:collapse;
    }

    table thead
    {
        font-size:1.2em;
        text-align:left;
        padding-top:5px;
        padding-bottom:4px;
        background-color:#2E82FF;
        color:#fff;
    }


    table tbody tr:nth-child(odd) {
        background-color: #D3D3D3;
        width: 500px;

    }


</style>

<form action="<?= site_url('RelatorioRequisicaoController/gerarPdf') ?>" method="post" target="_blank">

    <input type="hidden" id="tipo" name="tipo" value="<?= $r->getTipo() ?>">
    <input type="hidden" id="titulo" name="titulo" value="<?= $titulo ?>">
    <input type="hidden" id="dataInicio" name="dataInicio" value="<?= $r->getDataInicio() ?>">
    <input type="hidden" id="dataFim" name="dataFim" value="<?= $r->getDataFim() ?>">

    <table>
        <caption width="700px">Relatório Requisições <?= empty($titulo) ? '' : $titulo ?></caption>
        <thead>
            <tr>
                <td>Nome</td>
                <td>Departamento</td>
                <td>Qtde</td>
            </tr>
        </thead>
        <tbody>
            <? if (!empty($reqst)) { ?>
                <? foreach ($reqst as $v) { ?>
                    <tr>
                        <td><?= $v->getUsuario()->getNome() ?></td>
                        <td><?= $v->getDepartamento()->getNome() ?></td>
                        <td><?= $v->getQtde() ?></td>
                    </tr>
                <? } ?>
            <? } ?>

        </tbody>
        <tfoot>
            <tr>
                <td><input type="submit" value="Gerar PDF"></td>
            </tr>
        </tfoot>

    </table>
</form>