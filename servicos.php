<?php
include_once 'DAO/Servico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$servico = new Servico(); // Chama a classe de cliente

$servicos = $servico->index(); // Chama a Função index() para a pagina inicial

// 
if(isset($_POST['deletar'])) {
    $delete = $servico->deletar($_POST['idDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        echo $delete['mensagem'];
    }
}

?>

<?php echo $funcoes->the_header("Serviço"); ?>

<h1>Serviços</h1>
<a href="cadastrar_servico.php"><button type="button" class="btn btn-primary btn-sm">Novo Serviço</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Descricao</th>
            <th scope="col">Preço</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servicos as $serv) { ?>
        <tr>
            <th scope="row"><?php echo $serv['descricaoServico']; ?></th>
            <th scope="row"><?php echo $serv["valorServico"]; ?></th>            
            <td><a href="ver_servico.php?idServico=<?php echo $serv["idServico"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editar_servico.php?idServico=<?php echo $serv["idServico"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo $serv["idServico"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>