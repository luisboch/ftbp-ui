<form id="form-cadastro" action="<?= site_url('RequisicaoController/salvar'); ?>" 
      onsubmit="return carregar('RequisicaoController/salvar', $('#form-cadastro').serialize(), false)" 
      method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($requisicao) ? '' : $requisicao->getId(); ?>" />
       
    <table border="0" class="form-table">
        <caption><span>Abrir Requisição</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td>
                    <input type="text" id="titulo" name="titulo" value="<?= empty($requisicao) ? '' : $requisicao->getTitulo(); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea rows="4" cols="50" id="descricao" name="descricao"><?= empty($requisicao) ? '' : $requisicao->getDescricao(); ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Encaminhar para: </td>
                <td>
                    <select id="usuario_id" name="usuario_id">
                        <option value="">--selecione--</option>
                        <?
                        $usuario_id = (empty($requisicao) || $requisicao->getUsuario() == '') ? '' : $requisicao->getUsuario()->getId();
                        foreach ($usuarios as $v) {
                            ?>
                            <option value ="<?= $v->getId(); ?>" <?=$v->getId() === $usuario_id?'selected="selected"':''?> ><?= $v->getNome(); ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Prioridade: </td>
                <td>
                    <select id="prioridade" name="prioridade">
                        <? $prioridade = empty($requisicao) ? 'NORMAL' : $requisicao->getPrioridade(); ?>
                        <option <?=$prioridade==='MUITO_BAIXA'?'selected="selected"':''?> value="MUITO_BAIXA">Muito Baixa</option>
                        <option <?=$prioridade==='BAIXA'?'selected="selected"':''?> value="BAIXA">Baixa</option>
                        <option <?=$prioridade==='NORMAL'?'selected="selected"':''?> value="NORMAL">Normal</option>
                        <option <?=$prioridade==='ALTA'?'selected="selected"':''?> value="ALTA">Alta</option>
                        <option <?=$prioridade==='MUITO_ALTA'?'selected="selected"':''?> value="MUITO_ALTA">Muito Alta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Salvar"/></td>
            </tr>   
        </tbody>
    </table>
</form>
