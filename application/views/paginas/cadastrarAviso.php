<script>
   
   $("#setor").click(function(){
        if($(this).is(':checked')){
            $("#setor_check").css('display','block');
        }
        else{
            $("#setor_check").css('display','none');
        }
    });
    
    $("#usuario").click(function(){
        if($(this).is(':checked')){
            $("#usuario_check").css('display','block');
        }
        else{
            $("#usuario_check").css('display','none');
        }
    });
</script>

<form id="form-cadastro" action="<?= site_url('AvisoController/salvar'); ?>" 
      onsubmit="return carregar('AvisoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($aviso)?'':$aviso->getId();?>" />
    <table border="0" class="form-table">

        <caption><span>Cadastrar Aviso</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="nome" name="nome" value="<?=empty($aviso)?'':$aviso->getNome();?>"/>
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" id="descricao" name="descricao" value="<?=empty($aviso)?'':$aviso->getDescricao();?>"></textarea>
                </td>
            </tr>
            <tr>
                <td>Destino: </td>
                <td><input type="checkbox" name="todos"/>Todos</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="setor"  id="setor"/>Setor
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="setor_check" style="display: none;">
                        <option>T.I</option>
                        <option>R.H</option>
                        <option>Financeiro</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="usuario" id="usuario"/>Funcionario
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="usuario_check" style="display: none;">
                        <option>Zezinho</option>
                        <option>Mariazinha</option>
                        <option>Joãozinho</option>
                   </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit"value="<?=empty($aviso)?'Cadastrar':'Salvar';?>" /></td>
            </tr>   
        </tbody>
    </table>
</form>

