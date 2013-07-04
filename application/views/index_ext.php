<?
/**
 * @var $eventos Evento[] 
 * @var $cursos Curso[]
 */
?>
<div align="left" id="cursos" style="width: 46.5%;   padding: 10px; margin-left: 10px; border: 1px solid #c0c0c0; float: left">
    <span style="text-align: left; font-weight: bold">
        Cursos mais acessados
    </span>
    <hr>
    <? if (isset($cursos) && is_array($cursos)) { ?>
        <? foreach ($cursos as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url('Ver/curso/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "Ver/curso/" . $v->getId() ?>', null, true);"
                   >
                    <?= $v->getTitulo(); ?></a>
                <br>
            </p>
            <?
        }
    }
    ?>
</div>  
<div align="left" id="eventos" style="width: 46.5%;  padding: 10px; margin-left: 10px; border: 1px solid #c0c0c0; float: left">
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