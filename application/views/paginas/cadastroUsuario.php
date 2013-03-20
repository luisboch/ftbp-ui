<form id="form-cadastro" action="<?= site_url('UsuariosController/salvar'); ?>" onsubmit="return carregar('UsuariosController/salvar', $('#form-cadastro').serialize())" method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($usuario)?'':$usuario->getId();?>" />
    <table class="form-table">

        <caption><span>Cadastro de Usuários</span></caption>
        <tbody>
            <tr>
                <td>Tipo:</td>
                <td>
                    <select name="tipo_usuario" id="tipo_usuario">
                        <option value="2">Aluno</option>
                        <option value="3">Funcionário</option>
                        <option value="4">Professor</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Departamento:</td>
                <td>
                    <select name="departamento" id="departamento">
                        <? foreach ($deptos as $v){ ?>
                        <option value="<?=$v->getId();?>"><?=$v->getNome();?></option>
                        <?} ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nome:
                </td>
                <td><input type="text" name="nome" id="nome" value="<?= empty($usuario)?'':$usuario->getNome();?>" />
                </td>
            </tr>
            <tr>
                <td>Email:
                </td>
                <td><input type="text" name="email" id="email" value="<?=empty($usuario)?'':$usuario->getEmail();?>" />
                </td>
            </tr>
            <tr>
                <td>Senha:
                </td>
                <td><input type="password" name="senha" id="senha" value="<?=empty($usuario)?'':$usuario->getSenha();?>" />
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
