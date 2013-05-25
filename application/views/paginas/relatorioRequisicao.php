<form method="post" id="form-cadastro" action="<?= site_url('AreaController/salvar') ?>" onsubmit="return carregar('AreaController/salvar', $('#form-cadastro').serialize())">

    <table class="form-table">
        <caption><span>Relatório de Requisições</span></caption>
        <tbody>
            <tr>
                <td>Selecione um tipo</td>
                <td>
                    <select id="tipo">
                        <option></option>
                        <option>Abertura</option>
                        <option>Fechamento</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Periodo</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="dataInicio" name="dataInicio" placeholder="Data de Inicio">
                    <input type="text" id="dataFim" name="dataFim" placeholder="Data Final">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Enviar"></td>
            </tr>
        </tbody>
    </table>
</form>    