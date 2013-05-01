<form id="form-cadastro" action="<?= site_url('AvisoController/salvar'); ?>" 
      onsubmit="return carregar('AvisoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <!--<input type="hidden" name="id" id="id" value="<?= empty($aviso) ? '' : $aviso->getId(); ?>" /> -->
    <table border="0" class="form-table">

        <caption><span>Cadastrar Evento</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value=""/>
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" id="descricao" name="descricao" value=""></textarea>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value=""/>
                </td>
            </tr>
            <tr>
                <td>Local</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value=""/>
                </td>
            </tr>
            <tr>
                <td>Contato</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value=""/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Salvar" 
                           onClick="return confirmacao();"/></td>
            </tr>   
        </tbody>
    </table>
</form>

