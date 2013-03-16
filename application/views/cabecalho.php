<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/estilo.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL_HOME ?>resources/layout/reset.css" />

        <script type="text/javascript" src="<?= URL_HOME ?>resources/scripts/jquery.js"></script>

        <title>Gerenciador de Informações</title>
    </head>
    <body>
        <div id="corpo">
            <div id="cabecalho" style="text-align: center;">
                <div>
                <? if ($logado) { ?>
                    <div id="usuario-info">
                        <span><?= $session->getUsuario()->getNome(); ?></span>
                        <a href="<?=  site_url('Login/logout')?>">sair</a>
                    </div>
                <? } ?>
                </div>
                <img src="<?= URL_HOME ?>resources/imagens/logo.jpg" /></div>