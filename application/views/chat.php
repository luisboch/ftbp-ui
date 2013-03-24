<?if($logado){?>
<div id="chat">
    <div class="titulo">Chat</div>
    <ul>
    <?foreach($usuarios_ativos as $u){ ?>
        <li>
            <span class="usuario-nome" onclick="popup('<?=site_url('ChatController/u/'.$u->getId());?>', '<?=$u->getNome();?>', 300, 400)"><?=$u->getNome();?></span>
            <span class="departamento-nome"><?=$u->getDepartamento()===null?'':$u->getDepartamento()->getNome();?></span>
        </li>
    </ul>
    <?}?>
</div>
<?}?>