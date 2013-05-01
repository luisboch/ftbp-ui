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
                    Abertura Livraria
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="7" cols="50" id="descricao" name="descricao" readonly="readonly" >
A Livraria Evangélica de Curitiba, em parceria com a Faculdade Teológica Batista do Paraná, disponibiliza seus contatos a você, que deseja adquirir livros para os estudos.

                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    01/05/13
                </td>
            </tr>
            <tr>
                <td>Local</td>
                <td>
                    Campus Água Verde
                </td>
            </tr>
            <tr>
                <td>Contato</td>
                <td>
                    José da Silva 3333-4444
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Voltar" 
                           onClick=""/></td>
            </tr>   
        </tbody>
    </table>
</form>

