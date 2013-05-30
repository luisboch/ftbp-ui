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
    <? if (is_array($curso)) { ?>
        <? foreach ($curso as $v) { ?>
            <div class="resultado-pesquisa">
                <a href="<?= site_url('CursoController/verCurso/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "CursoController/verCurso/" . $v->getId() ?>', null, true);"
                   >
                    Titulo: <strong><?= $v->getNome() ?></strong> [Data Vestibular: <?= $v->getDataVestibular() == null ? '' : $v->getDataVestibular()->format('d/m/y') ?>]
                </a>

                <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::CURSO, true)) { ?>
                    <div style="text-align: right;color: #666">
                        <span>
                            <a href="<?= site_url('CursoController/alterarCurso/' . $v->getId()) ?>" 
                               onclick="return carregar('<?= "CursoController/alterarCurso/" . $v->getId() ?>', $('#form-cadastro').serialize());" 
                               class="button blue small link">ALTERAR</a>
                        </span>

                    </div>
                <? } ?>
            </div>    
            <?
        }
    }
    ?>

</div>