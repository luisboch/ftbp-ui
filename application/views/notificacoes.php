<?
if (isset($notfs) && is_array($notfs)) {

    foreach ($notfs as $v) {
        ?>
        <div class="resultado-pesquisa">
            <div class="pesquisa-desc"><a href="<?= site_url($v->getLink()) ?>" onclick="return carregar('<?=$v->getLink()?>', null, true);"><?= $v->getDescricao() ?></a></div>
            <div style="text-align: right;color: #666"><span>em <?= $v->getData()->format('d/m/y') ?></span></div>
        </div>

        <?
    }
}
?>