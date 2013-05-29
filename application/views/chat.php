<? if ($logado) { ?>
    <div id="chat">
        <div class="titulo">Chat (<span><?=count($usuarios_ativos)?></span>)</div>
        <div class="usuarios" style="display: <?=$session->getShowChat()?'block':'none'?>">
            <ul>
                <? foreach ($usuarios_ativos as $u) { ?>
                    <li onclick="popup('<?= site_url('ChatController/u/' . $u->getId()); ?>', '<?= $u->getNome(); ?>', 300, 400)">
                        <span class="usuario-nome" ><?= $u->getNome(); ?></span>
                        <span class="departamento-nome"><?= $u->getDepartamento() === null ? '' : $u->getDepartamento()->getNome(); ?></span>
                    </li>
                <? } ?>
            </ul>
        </div>
    </div>
<?
}?>