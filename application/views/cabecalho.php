<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/estilo.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/reset.css" />

        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/scrollto-1.4.3.1.min.js"></script>

        <!-- JQuery-UI dependencies-->
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/start/jquery-ui-1.10.2.custom.min.css" />
        <script type="text/javascript"  src="<?= URL_HOME ?>resources/scripts/jquery-ui-1.10.2.custom.js" ></script>

        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/core.js"></script>

        <script type="text/javascript" >
            var URL_HOME = '<?= URL_HOME ?>';
            var logado = <?= $logado ? 'true' : 'false' ?>;
        </script>

        <title>Gerenciador de Informações</title>
    </head>
    <body>

        <div id="corpo">
            <noscript>
                <div class="ui-state-highlight" style="text-align: center;padding:5px 260px;">
                    <span class="ui-icon-alert ui-icon" style="float: left"></span>
                    Atenção, para uma melhor experiência, habilite o Javascript no seu browser.
                </div>
            </noscript>
            <div style="position: relative;width: 500px;margin: auto;">
                <div id="bloco-mensagems" style="display:<?= empty($messages) ? 'none' : 'block;position:relative;'; ?>">
                    <div id="msg-titulo">Atenção</div>
                    <div id="msg-location">
                        <?
                        if ($messages != '') {
                            if (is_array($messages)) {
                                foreach ($messages as $v) {
                                    ?><div class="msg-item"><?= $v; ?></div><?
                                }
                            } else {
                                ?><?= $messages; ?><?
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="cabecalho" style="text-align: center;">
                <div>
                    <? if ($logado) { ?>
                        <div id="usuario-info">
                            <span><?= $session->getUsuario()->getNome(); ?></span>
                            <a href="<?= site_url('Login/logout') ?>">sair</a>
                        </div>
                    <? } else { ?>
                        <div id="usuario-info">
                            <a href="<?= site_url('Login/login') ?>">Login</a>
                        </div>
                    <? } ?>
                </div>
                <img src="<?= URL_HOME ?>resources/imagens/logo.jpg" /></div>