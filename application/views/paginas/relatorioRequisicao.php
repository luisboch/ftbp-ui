<script type="text/javascript">
    $(function(){
        $('.data').datepicker({ dateFormat: "yy-mm-dd" });
    })
</script>

<form method="post" id="form-cadastro" action="<?= site_url('RelatorioRequisicaoController/gerarRelatorio') ?>" >

    <table class="form-table">
        <caption><span>Relatório de Requisições</span></caption>
        <tbody>
            <tr>
                <td>Selecione um tipo</td>
                <td>
                    <select id="tipo" name="tipo">
                        <option></option>
                        <option value="0">Abertura</option>
                        <option value="1">Fechamento</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Periodo</td>            
                <td>
                    <input type="text" class="data" id="dataInicio" name="dataInicio" placeholder="Data de Inicio">
                    <input type="text" class="data" id="dataFim" name="dataFim" placeholder="Data Final">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Enviar"></td>
            </tr>
        </tbody>
    </table>
</form>    