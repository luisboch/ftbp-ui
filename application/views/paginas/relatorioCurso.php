<? /* @var $_grupo Grupo */ ?>
<script type="text/javascript">
    $(function() {
        $('.data').datepicker({dateFormat: "yy-mm-dd"});
    })
</script>

<form method="post" id="form-cadastro" 
      action="<?= site_url('RelatorioCursoController/gerarRelatorio') ?>"
      onsubmit="return carregar('RelatorioCursoController/gerarRelatorio',$(this).serialize(), true)">

    <table class="form-table">
        <caption><span>Relatório de Requisições</span></caption>
        <tbody>
            <tr>
                <td>Agrupar por:</td>
                <td>
                    <select id="tipo" name="tipo">
                        <option value="<?=  CursoAgrupamento::CURSO?>">Curso</option>
                        <option value="<?=  CursoAgrupamento::CURSO_AREA?>">Curso Area</option>
                        <option value="<?=  CursoAgrupamento::NIVEL?>">Nivel Graduação</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::RELATORIOS)) { ?>
                        <input type="submit" value="Enviar">
                    <? } ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>    