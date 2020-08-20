<?php
include_once 'DAO/OrdemServico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$ordemServico = new OrdemServico(); // Chama a classe de cliente

$ordemServicos = $ordemServico->index(); // Chama a Função index() para a pagina inicial

// 
if(isset($_POST['deletar'])) {
    $delete = $ordemServico->deletar($_POST['idDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        echo $delete['mensagem'];
    }
}

?>

<?php echo $funcoes->the_header("Ordem de Serviço"); ?>

<h1>Ordens de Serviço</h1>
<a href="cadastrar_os.php"><button type="button" class="btn btn-primary btn-sm">Nova OS</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Placa</th>
            <th scope="col">Descricao</th>
            <th scope="col">Serviços</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ordemServicos as $os) { ?>
        <tr>
            <th scope="row"><?php echo $os['placa']; ?></th>
            <th scope="row"><?php echo $os['descricao']; ?></th>
            <td><a href="servico_realizado.php?idOrdem=<?php echo $os["idOS"]; ?>"><button type="button" class="btn btn-warning btn-sm">Serviços</button></a></td>
            <td><a href="ver_os.php?idOrdem=<?php echo $os["idOS"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editar_os.php?idOrdem=<?php echo $os["idOS"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo $os["idOS"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>