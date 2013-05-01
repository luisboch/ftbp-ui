<style type="text/css">
    .resultado-pesquisa {
        padding: 5px;
        margin: 5px;
        border: 1px solid #888;
        float: right;
        width: 800px;
        text-align: left;
    }
    #menu-lateral{
        float: left; 
        text-align: left;
        border: 1px solid #888;
        width: 170px;
    }
    
    .resultado-pesquisa.MUITO_BAIXA{
        background:  #ffffcc;
    }
    
    .resultado-pesquisa.BAIXA{
        background:  #ffff99;
    }
    
    .resultado-pesquisa.NORMAL{
        background:  #ffcccc;
    }
    
    .resultado-pesquisa.ALTA{
        background:  #ff6666;
    }
    
    .resultado-pesquisa.MUITO_ALTA{
        background:  #ff0000;
    }
    
</style>

<strong><?= $titulo ?></strong>
<hr>
<div id="menu-lateral" >
    <ul>
        <li><a href="<?=site_url('RequisicaoController/entrada')?>" onclick="return carregar('RequisicaoController/entrada', null, true);">Entrada</a></li>
        <li><a href="<?=site_url('RequisicaoController/minhasRequisicoes')?>" onclick="return carregar('RequisicaoController/minhasRequisicoes', null, true);">Minhas Requisições</a></li>
    </ul>
</div>

<div>
    <? if (isset($reqst) && is_array($reqst)) { ?>
        <? foreach ($reqst as $v) { ?>
            <div class="resultado-pesquisa <?=$v->getPrioridade()?>">
                <a href="<?=site_url('RequisicaoController/ver/'.$v->getId())?>" 
                   onclick="return carregar('<?= "RequisicaoController/ver/".$v->getId()?>', null, true);"
                   >
                    <?= $v->getTitulo() ?>
                    "<?= $v->getCriadoPor()->getNome() ?>"
                </a>
                <div style="text-align: right;color: #666">
                    <?= $v->getDataCriacao()->format('d/M/y') ?>
                </div>
            </div>    
        <?
         
        }
    }
    ?>

</div>