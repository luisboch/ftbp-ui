<? /* @var $reslt CursoRelatorioResultado[] */ ?>
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

<form action="<?= site_url('RelatorioCursoController/gerarPdf') ?>" method="post" >

    <input type="hidden" id="tipo" name="tipo" value="<?= $tipo ?>">
    
    <table>
        <caption width="700px">Relatório de Visualizações de Curso</caption>
        <thead>
            <tr>
                <td><?=  CursoAgrupamento::getCabecalho($tipo);?></td>
                <td>Quantidade de Acessos</td>
            </tr>
        </thead>
        <tbody>
            <? if (!empty($reslt)) { ?>
                <? foreach ($reslt as $v) { ?>
                    <tr>
                        <?
                        if($tipo == CursoAgrupamento::CURSO){
                            echo '<td>'.$v->getCurso().'</td>';
                        } else if($tipo == CursoAgrupamento::CURSO_AREA){
                            echo '<td>'.$v->getArea().'</td>';
                        } else if($tipo == CursoAgrupamento::NIVEL){
                            echo '<td>'.  strtoupper($v->getNivelgraduacao()).'</td>';
                        }
                        ?>
                        <td><?= $v->getAcessos() ?></td>
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