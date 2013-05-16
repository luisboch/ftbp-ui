<form id="form-cadastro" action="<?= site_url('RequisicaoController/salvarIteracao'); ?>" 
      onsubmit="return carregar('RequisicaoController/salvarIteracao', $('#form-cadastro').serialize(), false)" 
      method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($requisicao) ? '' : $requisicao->getId(); ?>" />

    <?
    $status = $requisicao->getStatus();
    $dono = $session->getUsuario()->getId() == $requisicao->getCriadoPor()->getId();
    if (!$dono) {
        if ($status === 'ABERTO') {
            $status = 'EM_ANDAMENTO';
        }
    }
    ?>
    <table border="0" class="form-table">
        <caption><span>Requisição</span></caption>
        <tbody >
            <tr>
                <td>Titulo</td>
                <td><?= $requisicao->getTitulo(); ?></td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td><?= $requisicao->getDescricao(); ?></td>
            </tr>
            <tr>
                <td>Aberto por: </td>
                <td><span class="usuario-nome"><?= $requisicao->getCriadoPor()->getNome(); ?></span>  em <span class="data"><?= $requisicao->getDataCriacao()->format('d/m') ?></span> ás  <span class="data"><?= $requisicao->getDataCriacao()->format('H:i') ?></span></td>
            </tr>
            <tr>
                <td>Designado para:</td>
                <td><?= $requisicao->getUsuario()->getNome(); ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top">Atividades: </td>
                <td>
                    <? foreach ($requisicao->getIteracoes() as $it) { ?>
                        <div style="border: #DDD solid 1px;padding: 5px;margin: 2px">
                            <div><span class="usuario-nome"><?= $it->getUsuario()->getNome(); ?></span> em <span class="data"><?= $it->getDataCriacao()->format('d/m') ?></span> ás  <span class="data"><?= $it->getDataCriacao()->format('H:i') ?></span></div>
                            <span class="mensagem"><?= $it->getMensagem(); ?></span>
                        </div>
                    <? } ?>
                    <? if (count($requisicao->getIteracoes()) === 0) { ?>
                        Não há nenhuma atividade.
                    <? } ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><hr /></td>
            </tr>

            <tr>
                <td>Mensagem: </td>
                <td>
                    <textarea <?=$status=='FINALIZADO'&&!$dono?'disabled="disabled"':''?>  style="width: 400px;height: 90px;" name="mensagem" id="mensagem"></textarea>
                </td>
            </tr>
            <tr>
                <td>Encaminhar para: </td>
                <td>
                    <select id="usuario_id" <?=$status=='FINALIZADO'&&!$dono?'disabled="disabled"':''?> name="usuario_id">
                        <option value="">--selecione--</option>
                        <?
                        $usuario_id = $requisicao->getUsuario()->getId();
                        foreach ($usuarios as $v) {
                            ?>
                            <option value ="<?= $v->getId(); ?>" <?= $v->getId() === $usuario_id ? 'selected="selected"' : '' ?> ><?= $v->getNome(); ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alterar Prioridade: </td>
                <td>
                    <select id="prioridade" name="prioridade" <?=$status=='FINALIZADO'&&!$dono?'disabled="disabled"':''?> >

                        <?
                        $prioridade = $requisicao->getPrioridade();
                        ?>
                        <option <?= $prioridade === 'MUITO_BAIXA' ? 'selected="selected"' : '' ?> value="MUITO_BAIXA">Muito Baixa</option>
                        <option <?= $prioridade === 'BAIXA' ? 'selected="selected"' : '' ?> value="BAIXA">Baixa</option>
                        <option <?= $prioridade === 'NORMAL' ? 'selected="selected"' : '' ?> value="NORMAL">Normal</option>
                        <option <?= $prioridade === 'ALTA' ? 'selected="selected"' : '' ?> value="ALTA">Alta</option>
                        <option <?= $prioridade === 'MUITO_ALTA' ? 'selected="selected"' : '' ?> value="MUITO_ALTA">Muito Alta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alterar Status: </td>
                <td>
                    <?
                    $status = $requisicao->getStatus();
                    $dono = $session->getUsuario()->getId() == $requisicao->getCriadoPor()->getId();
                    if (!$dono) {
                        if ($status === 'ABERTO') {
                            $status = 'EM_ANDAMENTO';
                        }
                    }
                    ?>
                    <select id="status" <?=$status=='FINALIZADO'&&!$dono?'disabled="disabled"':''?> name="status" >
                        <option <?= $status === 'ABERTO' ? 'selected="selected"' : '' ?> value="ABERTO" disabled="disabled" >Aberto</option>
                        <option <?= $status === 'EM_ANDAMENTO' ? 'selected="selected"' : '' ?> value="EM_ANDAMENTO">Em Andamento</option>
                        <option <?= $status === 'FINALIZADO' ? 'selected="selected"' : '' ?> value="FINALIZADO">Finalizado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? if ($status != 'FINALIZADO' || $dono) { ?>
                        <input type="submit" value="Salvar"/>
                    <? } ?>
                </td>
            </tr>   
        </tbody>
    </table>
</form>
