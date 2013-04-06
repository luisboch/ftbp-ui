<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/estilo.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/reset.css" />

        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/jquery-1.9.1.js"></script>

        <!-- JQuery-UI dependencies-->
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/start/jquery-ui-1.10.2.custom.min.css" />
        <script type="text/javascript"  src="<?= URL_HOME ?>resources/scripts/jquery-ui-1.10.2.custom.js" ></script>

        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/core.js"></script>

        <script type="text/javascript" >
            var URL_HOME = '<?= URL_HOME ?>';
            var logado = <?=$logado?'true':'false'?>;
        </script>
        <title><?= $alvo->getNome(); ?></title>
    </head>
    <body>
        <div id='usr-messages' style="height: 250px;overflow: auto">
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Eu:</span><span class="msg">Olá</span><br></div>
            <div style="width: 100%"><span class="usr-nome">Paulo:</span><span class="msg">Olá</span><br></div>
        </div>
        <form method="post" onsubmit="return carregar('ChatController/enviarMensagem', $('#form-chat').serialize());" id="form-chat">
            <div id="usr-editor" style="height: 150px;"><textarea name="mensagem"></textarea>
                <div>
                    <input type="hidden" name="usr_id" value="<?=$alvo->getId();?>" />
                    <input type="submit" value="enviar" />
                </div>
            </div>
        </form>
    </body>
</html>
