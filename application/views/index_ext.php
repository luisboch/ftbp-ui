<div align="left" id="cursos" style="width: 240px;  padding: 10px; margin-left: 10px; border: 1px solid #c0c0c0; float: left">
    <span style="text-align: left; font-weight: bold">
        Cursos mais acessados <a class="simple-link" href="<?= site_url('CursoController/verMais') ?>" onclick="return carregar('CursoController/verMais', null, true);">ver mais</a>
    </span>
    <hr>
    <? if (isset($cursos) && is_array($cursos)) { ?>
        <? foreach ($cursos as $v) {
            ?>
            <p style="color: #FF6347">
                <a href="<?= site_url('RequisicaoController/ver/' . $v->getId()) ?>" 
                   onclick="return carregar('<?= "RequisicaoController/ver/" . $v->getId() ?>', null, true);"
                   >
                    <?=$v->getTitulo();?></a>
                <br>
            </p>
            <?
        }
    }
    ?>
</div>  