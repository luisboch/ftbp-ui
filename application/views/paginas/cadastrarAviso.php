<form id="form-cadastro" action="<?= site_url('AvisoController/salvar'); ?>" 
      onsubmit="return carregar('AvisoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($aviso)?'':$aviso->getId();?>" />
    <table>

        <caption><span>Cadastrar Aviso</span></caption>
        <tbody>
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="titulo" />
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" ></textarea>
                </td>
            </tr>
            <tr>
                <td>Destino: </td>
                <td>
                    <input type="checkbox" name="todos"/>Todos
                    <input type="checkbox" name="setor"/>Setor
                    <input type="checkbox" name="funcionario"/>Funcionario
                </td>
            </tr>
            <tr>
                <td><input type="submit" Value="Enviar" /></td>
            </tr>   
        </tbody>
    </table>
</form>

