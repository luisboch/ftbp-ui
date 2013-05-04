<form id="form-cadastro" action="<?= site_url('CursoController/salvar'); ?>" 
      onsubmit="return carregar('CursoController/salvar', $('#form-cadastro').serialize())" 
      method="post">
    <script type="text/javascript">
        $(function(){
            $('#dataVestibular').datepicker({ dateFormat: "dd/mm/yy" });
        })
    </script>
    <input type="hidden" name="id" id="id" value="<?= empty($curso)?'':$curso->getId();?>" />
    <table class="form-table">
        <caption>Cadastro de Cursos</caption>
        <tbody>
            <tr>
                <td>Nome do Curso</td>
                <td><input id="nome" name="nome" type="text" value="<?= empty($curso)?'':$curso->getNome();?>"></td>
            </tr>
            <tr>
                <td>Coordenador</td>
                <td><input id="coordenador" name="coordenador" type="text" value="<?= empty($curso)?'':$curso->getCoordenador();?>"></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><textarea id="descricao" name="descricao" rows="10" cols="30"><?= empty($curso)?'':$curso->getDescricao();?></textarea></td>
            </tr>
            <tr>
                <td>Corpo Docente</td>
                <td><textarea id="corpoDocente" name="corpoDocente" rows="10" cols="30"><?= empty($curso)?'':$curso->getCorpoDocente();?></textarea></td>
            </tr>
            <tr>
                <td> Público Alvo</td>
                <td><input id="publicoAlvo" name="publicoAlvo" type="text" value="<?= empty($curso)?'':$curso->getPublicoAlvo();?>"></td>
            </tr>
            <tr>
                <td>Valor (R$)</td>
                <td><input id="valor" name="valor" type="text" value="<?= empty($curso)?'':str_replace('.', ',', $curso->getValor());?>"></td>
            </tr>
             <tr>
                <td>Duração</td>
                <td><input id="duracao" name="duracao" type="text" value="<?= empty($curso)?'':$curso->getDuracao();?>"></td>
            </tr>
            <tr>
                <td>Video de Apresentação</td>
                <td><input id="videoApresentacao" name="videoApresentacao" type="text" value="<?= empty($curso)?'':$curso->getVideoApresentacao();?>"/></td>
            </tr>
          
            <tr>
                <td>Data do Vestibular</td>
                <td>
                    <input type="text" id="dataVestibular" name="dataVestibular" value="<?= empty($curso)|| $curso->getDataVestibular() == null ?'':$curso->getDataVestibular()->format('d/m/Y');?>"/>
                </td>
            </tr>
            
            <tr>
                <td>Area de Atuação</td>
                <td>
                    <select id="areaCurso" name ="areaCurso">
                       <?foreach($area as $v){?>    
                            <option value="<?=$v->getId()?>"><?=$v->getNome()?></option>
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
                <td><input type="type" id="email" name="email" value="<?= empty($curso)?'':$curso->getEmail();?>"></td>
            </tr>
            <tr>
                <td>Contatos da Secretaria</td>
                <td><input type="type" id="contatoSecretaria" name="contatoSecretaria" value="<?= empty($curso)?'':$curso->getContatoSecretaria();?>"></td>
            </tr>
            <tr>
                <td>Créditos</td>
                <td><input type="type" id="credito" name="credito" value="<?= empty($curso)?'':$curso->getCredito();?>"></td>
            </tr>
            <tr>
                <td>Upload de Arquivos</td>
                <td> <input type="file" name="arquivo" id="arquivo" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?= empty($curso)?'Cadastrar':'Atualizar'?>"></td>
            </tr>
        </tbody>
    </table>
</form>