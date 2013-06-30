<table class="form-table">
    <caption>Curso</caption>
    <tbody>
        <tr>
            <td>Nome do Curso</td>
            <td><?= $curso->getNome() ?></td>
        </tr>
        <tr>
            <td>Coordenador</td>
            <td><?= $curso->getCoordenador() ?></td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td><textarea id="descricao" name="descricao" rows="10" cols="30" readonly="readonly">
                    <?= $curso->getDescricao() ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>Corpo Docente</td>
            <td>
                <textarea id="corpoDocente" name="corpoDocente" rows="10" cols="30" readonly="readonly"><?= $curso->getCorpoDocente() ?>                </textarea>
            </td>
        </tr>
        <tr>
            <td>Público Alvo</td>
            <td><?= $curso->getPublicoAlvo() ?></td>
        </tr>
        <tr>
            <td>Valor</td>
            <td>R$ <?= str_replace('.', ',', $curso->getValor()) ?></td>
        </tr>
        <tr>
            <td>Duração</td>
            <td><?= $curso->getDuracao() ?> anos</td>
        </tr>
        <tr>
            <td>Video de Apresentação</td>
            <td>
                <div style="padding-top: 10px; margin-top: 10px">
                    <iframe width="420" height="315" src="http://www.youtube.com/embed/<?= $curso->getVideoApresentacao() ?>"
                            frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </td>
        </tr>

        <tr>
            <td>Data do Vestibular:</td>
            <td>
                <?= $curso->getDataVestibular()!=null?$curso->getDataVestibular()->format('d/m/Y'):''; ?>
            </td>
        </tr>

        <tr>
            <td>Area do Curso</td>
            <td>
                <?= $curso->getAreaCurso() == null ? '' : $curso->getAreaCurso()->getNome(); ?>
            </td>
        </tr>

        <tr>
            <td>Nivel</td>
            <td>
                <?= $curso->getNivelGraduacao() ?>
            </td>
        </tr>
        <tr>
            <td>E-mail de Coordenador </td>
            <td><?= $curso->getEmail() ?></td>
        </tr>
        <tr>
            <td>Contatos da Secretaria</td>
            <td><?= $curso->getContatoSecretaria() ?></td>
        </tr>
        <? if ($curso->getArquivos() != '' && is_array($curso->getArquivos()) && count($curso->getArquivos()) > 0) {
            ?>
            <tr>
                <td>Arquivos disponíveis:</td>
                <td>
                    <?
                    foreach ($curso->getArquivos() as $arq) {
                        ?><div style="margin: 5px;"><?= $arq->getDescricao(); ?>
                            <span style="color: #666666"> por <?= $arq->getUsuario()->getNome() ?>
                                em <?= $arq->getDataUpload()->format('d/m/y H:m'); ?></span><strong> <a href="<?= URL_HOME . $arq->getCaminho(); ?>" target="_new">baixar</a></strong>
                        </div><?
                    }
                    ?>
                </td>
            </tr>
        <? } ?>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Voltar"onclick="return goBack()">
                <? if ($_grupo != null && $_grupo->temAcesso(GrupoAcesso::CURSO, true)) { ?>
                    <input type="submit" value="Editar"onclick="return carregar('CursoController/alterarCurso/<?= $curso->getId(); ?>', null, true);">
                <? } ?>
            </td>
        </tr>
    </tbody>
</table>