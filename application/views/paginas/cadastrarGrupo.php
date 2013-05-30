<? /* @var $grupo Grupo */ ?>
<form method="post" id="form-cadastro" action="<?=site_url('GrupoController/salvar')?>" onsubmit="return carregar('GrupoController/salvar', $('#form-cadastro').serialize())">
    <input type="hidden" id="id" name="id" value="<?=empty($grupo)?'':$grupo->getId();?>" />
    <table class="form-table">
        <caption><span>Cadastro de Grupos</span></caption>
        <tbody>
            <tr>
                <td>Nome do Grupo</td>
                <td><input id="nome" name="nome"  type="text" value="<?=empty($grupo)?'':$grupo->getNome();?>"></td>
            </tr>
            <tr>
                <td>Acessos</td>
                <td>
                    <table style="width:200px;">
                        <thead>
                            <tr>
                                <th>Acesso</th>
                                <th>Pode acessar?</th>
                                <th>Pode Editar?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Avisos</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::AVISO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::AVISO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::AVISO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::AVISO,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Cursos</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::CURSO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::CURSO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::CURSO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::CURSO,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Cursos Area</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::CURSO_AREA?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::CURSO_AREA)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::CURSO_AREA?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::CURSO_AREA,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Eventos</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::EVENTO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::EVENTO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::EVENTO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::EVENTO,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Funcionários</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::USUARIO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::USUARIO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::USUARIO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::USUARIO,true)?'':'checked="checked"'?> /></td>
                                
                            </tr>
                            <tr>
                                <td>Grupo de Usuários</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::GRUPO_DE_USUARIO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::GRUPO_DE_USUARIO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::GRUPO_DE_USUARIO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::GRUPO_DE_USUARIO,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Relatórios</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::RELATORIOS?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::RELATORIOS)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::RELATORIOS?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::RELATORIOS,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Requisições</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::REQUISICAO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::REQUISICAO)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::REQUISICAO?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::REQUISICAO,true)?'':'checked="checked"'?> /></td>
                            </tr>
                            <tr>
                                <td>Setores</td>
                                <td><input type="checkbox" name="r_<?=GrupoAcesso::SETOR?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::SETOR)?'':'checked="checked"'?> /></td>
                                <td><input type="checkbox" name="w_<?=GrupoAcesso::SETOR?>" <?=empty($grupo)||!$grupo->temAcesso(GrupoAcesso::SETOR,true)?'':'checked="checked"'?> /></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?=empty($grupo)?'Cadastrar':'Salvar';?>"></td>
            </tr>
        </tbody>
    </table>
</form>