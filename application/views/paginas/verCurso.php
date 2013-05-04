<table class="form-table">
    <caption>Curso</caption>
    <tbody>
        <tr>
            <td>Nome do Curso</td>
            <td><?=$curso->getNome()?></td>
        </tr>
        <tr>
            <td>Coordenador</td>
            <td><?=$curso->getCoordenador()?></td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td><textarea id="descricao" name="descricao" rows="10" cols="30" readonly="readonly">
                    <?=$curso->getDescricao()?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>Corpo Docente</td>
            <td>
                <textarea id="corpoDocente" name="corpoDocente" rows="10" cols="30" readonly="readonly"><?=$curso->getCorpoDocente()?>                </textarea>
            </td>
        </tr>
        <tr>
            <td> Público Alvo</td>
            <td><?=$curso->getPublicoAlvo()?></td>
        </tr>
        <tr>
            <td>Valor</td>
            <td>R$ <?=$curso->getValor()?></td>
        </tr>
            <tr>
            <td>Duração</td>
            <td><?=$curso->getDuracao()?> anos</td>
        </tr>
        <tr>
            <td>Video de Apresentação</td>
            <td>
                <div style="padding-top: 10px; margin-top: 10px">
                    <iframe width="420" height="315" src="http://www.youtube.com/embed/<?=$curso->getVideoApresentacao()?>"
                            frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </td>
        </tr>

        <tr>
            <td>Data do Vestibular</td>
            <td>
               <?=$curso->getDataVestibular()?>
            </td>
        </tr>

        <tr>
            <td>Area de Atuação</td>
            <td>
                <?=$curso->getAreaCurso()?>
            </td>
        </tr>

        <tr>
            <td>Nivel</td>
            <td>
                <?=$curso->getNivelGraduacao()?>
            </td>
        </tr>
        <tr>
            <td>E-mail de Coordenador </td>
            <td><?=$curso->getEmail()?></td>
        </tr>
        <tr>
            <td>Contatos da Secretaria</td>
            <td><?=$curso->getContatoSecretaria()?></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Voltar"onclick="javascript:window.history.go(-1);location.reload(true);"></td>
        </tr>
        
        
    </tbody>
</table>