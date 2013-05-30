<table>
    <caption width="700px">Relatório Requisições</caption>
    <thead>
        <tr>
            <td colspan="2">Requisições encerradas</td>
        </tr>
        <tr>
            <td>Nome</td>
            <td>Departamento</td>
            <td>Qtde</td>
        </tr>
    </thead>
    <tbody>
        <?foreach ($reqst as $v){?>
        <tr>
            <td><?= $v->getUsuario()->getNome()?></td>
            <td><?= $v->getDepartamento()->getNome()?></td>
            <td><?= $v->getQtde()?></td>
        </tr>
        <?}?>
    </tbody>
</table>