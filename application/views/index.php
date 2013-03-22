<div align="left" id="notificacao" style="width: 240px;  padding: 10px;
     border: 1px solid #c0c0c0; 
     float: left;
     ">
    <span style="text-align: left; font-weight: bold">
        Últimas Notificações <a class="simple-link" href="<?=site_url('NotificacaoController/verMais')?>" onclick="return carregar('NotificacaoController/verMais');">ver mais</a>
    </span>
    <hr>
    <? if (is_array($notfs)) { ?>
        <? foreach ($notfs as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= $v->getLink() ?>" onclick="return carregar('<?= $v->getLink() ?>');"><?= $v->getDescricao() ?></a>
                <br>
                <div style="text-align: right;color: #666;"><span>em <?= $v->getData()->format('d/M/y') ?></span></div>
            </p>
        <?
        }
    }
    ?>
</div>

<div align="left" id="Compromissos" style="width: 240px;  padding: 10px; margin-left: 10px;
     border: 1px solid #c0c0c0; 
     float: left">
    <span style="text-align: left; font-weight: bold">
        Compromissos
    </span>
    <hr>
    <p><a href="#">Reunião Terça as 10:00</a></p>
</div>