<div align="left" id="notificacao" style="width: 240px;  padding: 10px;
     border: 1px solid #c0c0c0; 
     float: left;
     ">
    <span style="text-align: left; font-weight: bold">
        Últimas Notificações <a class="simple-link" href="<?= site_url('NotificacaoController/verMais') ?>" onclick="return carregar('NotificacaoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (is_array($notfs)) { ?>
        <? foreach ($notfs as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url($v->getLink()) ?>" onclick="return carregar('<?= $v->getLink() ?>', {}, true);"><?= $v->getDescricao() ?></a>
                <br>
            <div style="text-align: right;color: #666;"><span>em <?= $v->getData()->format('d/m/y') ?></span></div>
        </p>
        <?
    }
}
?>
</div>
 <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::AVISO)) { ?>
<div align="left" id="aviso" style="width: 200px;  padding: 10px; margin-left: 10px;
     border: 1px solid #c0c0c0; 
     float: left">
    <span style="text-align: left; font-weight: bold">
        Avisos <a class="simple-link" href="<?= site_url('AvisoController/verMais') ?>" onclick="return carregar('AvisoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (is_array($aviso)) { ?>
        <? foreach ($aviso as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url('AvisoController/verAviso/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "AvisoController/verAviso/" . $v->getId() ?>', null, true);"
                   >
                    <?= $v->getLido() === 'f' ? '<strong>' . $v->getTitulo() . '</strong>' : $v->getTitulo() ?></a>
                (<?= $v->getCriadoPor()->getNome() ?>)
                <br>
            </p>
            <?
        }
    }
    ?>
</div>
 <? }?>
<? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::REQUISICAO)) { ?>
<div align="left" id="aviso" style="width: 200px;  padding: 10px; margin-left: 10px;
     border: 1px solid #c0c0c0; 
     float: left">
    <span style="text-align: left; font-weight: bold">
        Últimas Requisicoes <a class="simple-link" href="<?= site_url('RequisicaoController/verMais') ?>" onclick="return carregar('RequisicaoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (isset($reqst) && is_array($reqst)) { ?>
        <? foreach ($reqst as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url('RequisicaoController/ver/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "RequisicaoController/ver/" . $v->getId() ?>', null, true);"
                   >
                    <?=$v->getTitulo();?></a>
                (<?= $v->getCriadoPor()->getNome() ?>)
                <br>
            </p>
            <?
        }
    }
    ?>
</div>
<? } ?>
<? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::EVENTO)) { ?>
<div align="left" id="eventos" style="width: 240px; padding: 10px; margin-left: 10px; border: 1px solid #c0c0c0; float: left">
    <span style="text-align: left; font-weight: bold">
        Próximos eventos
    </span>
    <hr>
    <? if (isset($eventos) && is_array($eventos)) { ?>
        <? foreach ($eventos as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url('Ver/evento/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "Ver/evento/" . $v->getId() ?>', null, true);">
                    Titulo: <strong><?= $v->getTitulo() ?></strong> 
                    [Data: <?= $v->getDataEvento() == null ? '' : $v->getDataEvento()->format('d/m/y') ?>]
                </a>
                <br>
            </p>
            <?
        }
    }
    ?>
</div>
<? } ?>  