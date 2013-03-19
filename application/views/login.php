
<div id="login">
    <form name="login" method="post" action="<?= site_url('Login/logar') ?>">
        <table>
            <caption>Tela de Acesso</caption>
            <tr>
                <td>Email</td>
                <td><input name="email" type="text" size="30" /></td>
            </tr>
            <tr>
                <td>Senha</td>
                <td><input name="senha" type="password" size="30" /></td>
            </tr>
            <? if ($error) { ?>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <div class="ui-state-error" style="margin: 10px;"><span class="ui-icon ui-icon-alert" style="float: left"></span>Usuário ou senha inválidos</div>
                    </td>
                </tr>
            <? } ?>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <input name="btn_submit" type="submit" value="Entrar">
                </td>
            </tr>
        </table>
    </form>
</div>
