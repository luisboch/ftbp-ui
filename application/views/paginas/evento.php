<?
/* @var $evento Evento[] */
?>
<style type="text/css">
   .resultado-pesquisa {
        padding: 5px;
        margin: 5px;
        border: 1px solid #888;
        float: right;
        width: 980px;
        text-align: left;
    }
</style>

<strong><?= $titulo ?></strong>
<hr>
<div>
    <?
    if (is_array($evento)) { ?>
        <? foreach ($evento as $v) { ?>
            <div class="resultado-pesquisa">
                <a href="<?=site_url('EventoController/verEvento/'.$v->getId())?>" 
                   onclick="return carregar('<?= "EventoController/verEvento/".$v->getId()?>', null, true);">
                    Titulo: <strong><?= $v->getTitulo() ?></strong> 
                    [Data Evento: <?=$v->getDataEvento() == null?'':$v->getDataEvento()->format('d/m/y')?>]
                </a>
            </div>    
        <?
         
        }
    }
    ?>

</div>