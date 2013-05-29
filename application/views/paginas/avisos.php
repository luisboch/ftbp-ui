<style type="text/css">
    .resultado-pesquisa-aviso {
        padding: 5px;
        margin: 5px;
        border: 1px solid #888;
        float: right;
        width: 800px;
        text-align: left;
    }
    #menu-lateral-aviso{
        float: left; 
        text-align: left;
        border: 1px solid #888;
        width: 170px;
    }
</style>

<strong><?= $titulo ?></strong>
<hr>
<div id="menu-lateral-aviso" >
    <ul>
        <li><a href="<?=site_url('AvisoController/verMais')?>" onclick="return carregar('AvisoController/verMais', null, true);">Entrada Avisos</a></li>
        <li><a href="<?=site_url('AvisoController/meusAvisos')?>" onclick="return carregar('AvisoController/meusAvisos', null, true);">Meus Avisos</a></li>
    </ul>
</div>

<div>
    <? if (is_array($aviso)) { ?>
        <? foreach ($aviso as $v) { ?>
            <div class="resultado-pesquisa-aviso">
                <a href="<?=site_url('AvisoController/verAviso/'.$v->getId())?>" 
                   onclick="return carregar('<?= "AvisoController/verAviso/".$v->getId()?>', null, true);"
                   >
                    <?= $v->getLido() === 'f' ? '<strong>'. $v->getTitulo() . '</strong>' : $v->getTitulo() ?>
                    "<?= $v->getCriadoPor()->getNome() ?>"
                </a>
                <div style="text-align: right;color: #666">
                    <span>
                        <a href="<?=site_url('AvisoController/deletarAviso/'.$v->getId()).'/'.$opcao?>" 
                            onclick="return carregar('<?= "AvisoController/deletarAviso/".$v->getId()."/".$opcao?>', $('#form-cadastro').serialize());" 
                            class="button blue small link">DELETAR</a>
                    </span>
                    <?= $v->getDataCriacao()->format('d/M/y') ?>
                </div>
            </div>    
        <?
         
        }
    }
    ?>

</div>