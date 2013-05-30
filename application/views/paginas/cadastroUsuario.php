<?php /* @var $grupos Grupo[] */ ?>
<?php /* @var $usuario Usuario */ ?>
<form id="form-cadastro" action="<?= site_url('UsuariosController/salvar'); ?>" onsubmit="return carregar('UsuariosController/salvar', $('#form-cadastro').serialize())" method="post">
    <input type="hidden" name="id" id="id" value="<?= empty($usuario) ? '' : $usuario->getId(); ?>" />
    <table class="form-table">

        <caption><span>Cadastro de Usuários</span></caption>
        <tbody>
            <tr>
                <td>Tipo:</td>
                <td>
                    <select name="tipo_usuario" id="tipo_usuario">
                        <option <?= !empty($usuario) && $usuario->getTipoUsuario() == 3 ? 'selected="selected"' : ''; ?>value="3">Funcionário</option>
                        <option <?= !empty($usuario) && $usuario->getTipoUsuario() == 4 ? 'selected="selected"' : ''; ?>value="4">Professor</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Departamento:</td>
                <td>
                    <select name="departamento" id="departamento" title="Obrigatório se o tipo do usuário for Funcionário">
                        <option value="">selecione</option>
                        <? foreach ($deptos as $v) { ?>
                            <option <?= empty($usuario) ? '' : ($usuario->getDepartamento() == null ? '' : ($usuario->getDepartamento()->getId() == $v->getId() ? 'selected="selected"' : '')) ?> value="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Responsável:</td>
                <td>
                    <input type="checkbox" <?= empty($usuario) ? '' : ($usuario->getResponsavel() === true ? 'checked="checked"' : '') ?> name="responsavel" />
                </td>
            </tr>
            <tr>
                <td>Nome:
                </td>
                <td><input type="text" name="nome" id="nome" value="<?= empty($usuario) ? '' : $usuario->getNome(); ?>" />
                </td>
            </tr>
            <tr>
                <td>Email:
                </td>
                <td><input type="text" name="email" id="email" value="<?= empty($usuario) ? '' : $usuario->getEmail(); ?>" />
                </td>
            </tr>
            <tr>
                <td>Senha:
                </td>
                <td><input type="password" name="senha" id="senha" value="<?= empty($usuario) ? '' : $usuario->getSenha(); ?>" />
                </td>
            </tr>
            <tr>
                <td>Grupo:
                </td>
                <td><select name="grupo_id">
                        <?
                        $grupoId = $usuario == null || $usuario->getGrupo() == null ? null : $usuario->getGrupo()->getId();
                        foreach ($grupos as $g) {
                            ?><option value="<?= $g->getId(); ?>" <?= $grupoId == $g->getId() ? 'selected="selected"' : '' ?>><?= $g->getNome(); ?></option><?
                        }
                        ?>
                    </select>
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
