<div align="left" id="notificacao" style="width: 240px;  padding: 10px;
     border: 1px solid #c0c0c0; 
     float: left;
     ">
    <span style="text-align: left; font-weight: bold">
        Últimas Notificações <a class="simple-link" href="<?=site_url('NotificacaoController/verMais')?>" onclick="return carregar('NotificacaoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (is_array($notfs)) { ?>
        <? foreach ($notfs as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url($v->getLink()) ?>" onclick="return carregar('<?= $v->getLink() ?>');"><?= $v->getDescricao() ?></a>
                <br>
                <div style="text-align: right;color: #666;"><span>em <?= $v->getData()->format('d/M/y') ?></span></div>
            </p>
        <?
        }
    }
    ?>
</div>

<div align="left" id="aviso" style="width: 240px;  padding: 10px; margin-left: 10px;
    border: 1px solid #c0c0c0; 
    float: left">
    <span style="text-align: left; font-weight: bold">
        Avisos <a class="simple-link" href="<?=site_url('AvisoController/verMais')?>" onclick="return carregar('AvisoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (is_array($aviso)) { ?>
        <? foreach ($aviso as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?=site_url('AvisoController/verAviso/'.$v->getId())?>" 
                   onclick="return carregar('<?= "AvisoController/verAviso/".$v->getId()?>', null, true);"
                   >
                    <?= $v->getLido() === 'f' ? '<strong>'. $v->getTitulo() . '</strong>' : $v->getTitulo() ?></a>
                (<?= $v->getCriadoPor()->getNome() ?>)
                <br>
            </p>
        <?
        }
    }
    ?>
</div>  