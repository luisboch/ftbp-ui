<form method="post" action="<?=site_url('DepartamentoController/salvar')?>">
    <table>
        <caption>Cadastro de Setores</caption>
        <tbody>
            <tr>
                <td>Nome do Setor</td>
                <td><input id="nome" name="nome"  type="text"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Cadastrar"></td>
            </tr>
        </tbody>
    </table>
</form>