<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action="<?=site_url('UsuariosController/salvar');?>" method="post">
            <table class="data_form">
                <thead>
                    <th>
                        <td colspan="2">
                            Dados do registro
                        </td>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Tipo:</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option>Funcionario</option>
                                <option>Professor</option>
                                <option>Aluno</option>
                            </select>
                        </td>
                    </tr>
                <tbody>
                    <tr>
                        <td>Nome:
                        </td>
                        <td><input type="text" name="nome" id="nome" value="<?=$nome?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email:
                        </td>
                        <td><input type="text" name="email" id="email" value="<?=$email?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Senha:
                        </td>
                        <td><input type="password" name="senha" id="senha" value="<?=$senha?>" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="salvar" value="Salvar" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>
