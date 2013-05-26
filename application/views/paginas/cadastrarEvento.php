<script type="text/javascript">
        $(function(){
            $('#data').datepicker({ dateFormat: "dd/mm/yy" });
        })
    </script>
<form id="form-cadastro" action="<?= site_url('EventoController/salvar'); ?>" 
      onsubmit="return carregar('EventoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    
    <input type="hidden" name="id" id="id" value="<?= empty($evento) ? '' : $evento->getId(); ?>" /> 
    
    <table border="0" class="form-table">

        <caption><span>Cadastrar Evento</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value="<?= empty($evento) ? '' : $evento->getTitulo(); ?>" />
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" id="descricao" name="descricao" ><?= empty($evento) ? '' : $evento->getDescricao(); ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    <input type="text" id="data" name="data" value="<?= empty($evento) || $evento->getData() == null ? '' : $evento->getDataEvento()->format('d/m/Y'); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Local</td>
                <td>
                    <input type="text" id="local" name="local" value="<?= empty($evento) ? '' : $evento->getLocal(); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Contato</td>
                <td>
                    <input type="text" id="contato" name="contato" value="<?= empty($evento) ? '' : $evento->getContato(); ?>"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?= empty($evento)?'Cadastrar':'Atualizar'?>"/></td>
            </tr>   
        </tbody>
    </table>
</form>

