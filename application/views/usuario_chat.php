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
            var logado = <?= $logado ? 'true' : 'false' ?>;
        </script>
        <title><?= $alvo->getNome(); ?></title>
    </head>
    <body>
        <div id='usr-messages' style="height: 250px;overflow: auto">
            <? foreach ($mensagens as $msg) { ?>
                <div style="width: 100%"><span class="usr-nome"><?= $msg->getUsuario()->getNome(); ?>: </span><span class="msg"><?= $msg->getMensagem(); ?></span><br></div>
            <? } ?>
        </div>
        <form method="post" onsubmit="return enviarMensagem();" id="form-chat">
            <div id="usr-editor" style="width: 100%;">
                <textarea style="width: 100%;height: 100px;" name="mensagem"></textarea>
                <div style="text-align: right;">
                    <input type="hidden" name="usr_id" value="<?= $alvo->getId(); ?>" />
                    <input type="submit" value="enviar" />
                </div>
            </div>
        </form>
        <script type="text/javascript">

            $(function() {

                $('#usr-messages').scrollTop($('#usr-messages').innerHeight());

                window.setInterval(function() {

                    carregar('ChatController/atualizarMensagens',
                            {'usr_id': $('input[name=usr_id]').val()}, false,
                            function(data) {
                                var msgs = $(data.documentElement).find('mensagens');
                                var div = $('#usr-messages').html('');
                                $(msgs).children().each(function() {
                                    var mensagem = $(this).find('mensagem').text();
                                    var usuario = $(this).find('nome').text();
                                    var lido = $(this).find('lido').text() === 'true';
                                    var data = $(this).find('data').text();

                                    var html = '<div style="width: 100%"><span class="usr-nome">' + usuario + ': </span><span class="msg" style="' + (lido ? '' : 'font-weight:bold') + '">' + mensagem + '</span><br></div>';
                                    div.append(html);
                                });

                                $('#usr-messages').scrollTop($('#usr-messages').innerHeight());
                            })


                }, 5000);

                // Adiciona o evento para capturar os enters do textarea
                $('textarea').keyup(function(e) {
                    if (e.keyCode === 13) {
                        enviarMensagem();
                    }
                });

            });

            function enviarMensagem() {

                try {
                    if ($('textarea').val() !== '') {
                        carregar('ChatController/enviarMensagem',
                                $('#form-chat').serialize(),
                                false,
                                function() {
                                })
                    }
                } catch (e) {
                    // Nothing to do
                }

                $('textarea[name=mensagem]').val('');
                return false;
            }
        </script>
    </body>
</html>
