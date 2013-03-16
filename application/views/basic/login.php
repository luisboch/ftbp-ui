<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            .table_form tr td:first-child{
                text-align: right;
            }
            
            .table_form tr td:last-child{
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div>
            
        </div>
        <form action="<?=site_url('Login/logar');?>" method="post">
        <div style="position: relative;margin: auto;width: 200px;background: #a4daff; border: #54b8fc;border-radius: 2px;padding: 10px;color: #333;margin-top:15%;">
            <table class="table_form">
                <tbody>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email" id ="email" /></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="password" name="senha" id ="senha" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right"><input type="submit" value="Logar" /></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        </form>
    </body>
</html>
