<?
if (isset($resultado) && is_array($resultado)) {

    foreach ($resultado as $v) {
        ?>
        <div class="resultado-pesquisa">
            <div class="pesquisa-titulo"><a href="<?= site_url($v->getLink()) ?>" onclick="return carregar('<?=$v->getLink()?>', null, true);"><?= $v->getTitulo() ?></a></div>
            <div class="pesquisa-desc"><a href="<?= site_url($v->getLink()) ?>" onclick="return carregar('<?=$v->getLink()?>', null, true);"><?= $v->getBreveDescricao() ?></a></div>
        </div>

        <?
    }
}
?>