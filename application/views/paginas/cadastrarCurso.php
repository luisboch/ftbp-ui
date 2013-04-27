<script>
     
    function ano(){
        var data = '<option value="1990">1990</option>"';
        var i = 1990;
        while (i < 2015){
            data += '<option value="'+i+'">'+i+'</option>"';
            i++;
        }
        return data;
    }
    
    function mes(){
        var data ='<option value="01">Janeiro</option>';
        data +='<option value="02">Fevereiro</option>';
        data +='<option value="03">Março</option>';
        data +='<option value="04">Abril</option>';
        data +='<option value="05">Maio</option>';
        data +='<option value="06">Junho</option>';
        data +='<option value="07">Julho</option>';
        data +='<option value="08">Agosto</option>';
        data +='<option value="09">Setembro</option>';
        data +='<option value="10">Outubro</option>';
        data +='<option value="11">Novembro</option>';
        data +='<option value="12">Dezembro</option>';
        return data;
    }
    
    $(function(){
        $("#mes_inicio").html(mes());
        $("#ano_inicio").html(ano());
        $("#mes_fim").html(mes());
        $("#ano_fim").html(ano());
    });
    
</script>
<form id="form-cadastro" action="<?= site_url('CursoController/salvar'); ?>" 
      onsubmit="return carregar('CursoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($curso)?'':$curso->getId();?>" />
    <table class="form-table">
        <caption>Cadastro de Cursos</caption>
        <tbody>
            <tr>
                <td>Nome do Curso</td>
                <td><input id="nome" name="nome" type="text"></td>
            </tr>
            <tr>
                <td>Coordenador</td>
                <td><input id="coordenador" name="coordenador" type="text"></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><textarea id="descricao" name="descricao" rows="10" cols="30"></textarea></td>
            </tr>
            <tr>
                <td>Corpo Docente</td>
                <td><textarea id="corpo_docente" name="corpo_docente" rows="10" cols="30"></textarea></td>
            </tr>
            <tr>
                <td> Público Alvo</td>
                <td><input id="publico_alvo" name="publico_alvo" type="text"></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><input id="valor" name="valor" type="text"></td>
            </tr>
            <tr>
                <td>Video de Apresentação</td>
                <td><input id="video" name="video" type="text"></td>
            </tr>
          
            <tr>
                <td>Data do Vestibular</td>
                <td>
                    <select id="mes_inicio" name="mes_inicio"></select> /
                    <select id="ano_inicio" id="ano_inicio"></select>
                </td>
            </tr>
            
            <tr>
                <td>Area de Atuação</td>
                <td>
                    <select id="area" name ="area">
                        <option>rh</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Nivel</td>
                <td>
                    <select id="nivel" name ="nivel">
                        <option>Graduação</option>
                        <option>Pós-Graduação</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>E-mail de Coordenador </td>
                <td><input type="type" id="email" name="email"></td>
            </tr>
            <tr>
                <td>Contatos da Secretaria</td>
                <td><input type="type" id="contatos" name="contatos"></td>
            </tr>
            <tr>
                <td>Upload de Arquivos</td>
                <td> <input type="file" name="arquivo" id="arquivo" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Cadastrar"></td>
            </tr>
        </tbody>
    </table>
</form>