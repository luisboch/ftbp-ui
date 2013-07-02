<? /* @var $_grupo Grupo */ ?>

<form id="form-cadastro" action="<?= site_url('CursoController/salvar'); ?>" 
      method="post" enctype="multipart/form-data">
    <script type="text/javascript">
        $(function() {
            $('#dataVestibular').datepicker({dateFormat: "dd/mm/yy"});
        })
<? if (!empty($curso)) { ?>
            function confirmarExclusão(msg) {
                dp = <?= $session->getUsuario()->getDepartamento() != '' ? $session->getUsuario()->getDepartamento()->getId() : 'null' ?>;

                if (confirm("Você realmente deseja excluir este arquivo?")) {
                    carregar('CursoController/excluirArquivo',
                            {
                                usuario:<?= $session->getUsuario()->getId() ?>,
                                departamento: dp,
                                curso:<?= $curso->getId() ?>,
                                mensagem: msg
                            }, false);
                }

                return false;
            }
<? } ?>

    </script>
    <input type="hidden" name="id" id="id" value="<?= empty($curso) ? '' : $curso->getId(); ?>" />
    <table class="form-table">
        <caption>Cadastro de Cursos</caption>
        <tbody>
            <tr>
                <td>Nome do Curso</td>
                <td><input id="nome" name="nome" type="text" value="<?= empty($curso) ? '' : $curso->getNome(); ?>"></td>
            </tr>
            <tr>
                <td>Coordenador</td>
                <td><input id="coordenador" name="coordenador" type="text" value="<?= empty($curso) ? '' : $curso->getCoordenador(); ?>"></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><textarea id="descricao" name="descricao" rows="10" cols="30"><?= empty($curso) ? '' : $curso->getDescricao(); ?></textarea></td>
            </tr>
            <tr>
                <td>Corpo Docente</td>
                <td><textarea id="corpoDocente" name="corpoDocente" rows="10" cols="30"><?= empty($curso) ? '' : $curso->getCorpoDocente(); ?></textarea></td>
            </tr>
            <tr>
                <td>Público Alvo</td>
                <td><input id="publicoAlvo" name="publicoAlvo" type="text" value="<?= empty($curso) ? '' : $curso->getPublicoAlvo(); ?>"></td>
            </tr>
            <tr>
                <td>Valor (R$)</td>
                <td><input id="valor" name="valor" type="text" value="<?= empty($curso) ? '' : str_replace('.', ',', $curso->getValor()); ?>"></td>
            </tr>
            <tr>
                <td>Duração</td>
                <td><input id="duracao" name="duracao" type="text" value="<?= empty($curso) ? '' : $curso->getDuracao(); ?>"></td>
            </tr>
            <tr>
                <td>Video de Apresentação</td>
                <td><input id="videoApresentacao" name="videoApresentacao" type="text" value="<?= empty($curso) ? '' : $curso->getVideoApresentacao(); ?>"/></td>
            </tr>

            <tr>
                <td>Data do Vestibular</td>
                <td>
                    <input type="text" id="dataVestibular" name="dataVestibular" value="<?= empty($curso) || $curso->getDataVestibular() == null ? '' : $curso->getDataVestibular()->format('d/m/Y'); ?>"/>
                </td>
            </tr>

            <tr>
                <td>Area do Curso</td>
                <td>
                    <select id="areaCurso" name="areaCurso">
                        <?
                        $areaAtual = ($curso == null || $curso->getAreaCurso() == null) ? null : $curso->getAreaCurso()->getId();
                        foreach ($area as $v) {
                            ?>    
                            <option  value="<?= $v->getId() ?>" <?= $areaAtual == $v->getId() ? 'selected="selected"' : ''; ?>><?= $v->getNome() ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Nivel</td>
                <td>
                    <select id="nivelGraduacao" name ="nivelGraduacao">
                        <option value="graduacao" >Graduação</option>
                        <option value="Pós-Graduação">Pós-Graduação</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>E-mail de Coordenador </td>
                <td><input type="type" id="email" name="email" value="<?= empty($curso) ? '' : $curso->getEmail(); ?>"></td>
            </tr>
            <tr>
                <td>Contatos da Secretaria</td>
                <td><input type="type" id="contatoSecretaria" name="contatoSecretaria" value="<?= empty($curso) ? '' : $curso->getContatoSecretaria(); ?>"></td>
            </tr>
<!--            <tr>
                <td>Créditos</td>
                <td><input type="type" id="credito" name="credito" value="<?= empty($curso) ? '' : $curso->getCredito(); ?>"></td>
            </tr>-->
            <tr>
                <td>Upload de Arquivos</td>
                <td>
                    <input type="file" name="arquivo" id="arquivo" /><br>
                    <strong>Descrição:</strong><input type="text" name="arq_desc" id="arq_desc">
                </td>
            </tr>
            <? if ($curso != null && $curso->getArquivos() != '' && is_array($curso->getArquivos()) && count($curso->getArquivos()) > 0) {
                ?>
                <tr>
                    <td>Arquivos disponíveis:</td>
                    <td>
                        <?
                        if (isset($arquivos) && is_array($arquivos)) {
                            foreach ($arquivos as $arq) {
                                ?><div style="margin: 5px;"><?= $arq->getDescricao(); ?>
                                    <span style="color: #666666"> por <?= $arq->getUsuario()->getNome() ?>
                                        em <?= $arq->getDataUpload()->format('d/m/y H:m'); ?></span>
                                    <strong> <a href="<?= URL_HOME . $arq->getCaminho(); ?>" target="_new">baixar</a>
                                        <a href="" onclick="return confirmarExclusão('<?= $arq->getDescricao(); ?>')">excluir</a></strong>
                                </div><?
                            }
                        }
                        ?>
                    </td>
                </tr>
            <? } ?>
            <tr>
                <td></td>
                <td>
                    <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::CURSO, true)) { ?>
                        <input type="submit" value="<?= empty($curso) ? 'Cadastrar' : 'Atualizar' ?>">
                    <? } ?>
                </td>
            </tr>

        </tbody>
    </table>
</form>