<?php
include_once 'DAO/Peca.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$peca = new Peca(); // Chama a classe de cliente

$pecas = $peca->index(); // Chama a Função index() para a pagina inicial

// 
if(isset($_POST['deletar'])) {
    $delete = $peca->deletar($_POST['idDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        echo $delete['mensagem'];
    }
}

?>

<?php echo $funcoes->the_header("Peças"); ?>

<h1>Peças</h1>
<a href="cadastrar_peca.php"><button type="button" class="btn btn-primary btn-sm">Nova Peça</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Descricao</th>
            <th scope="col">Preço</th>
            <th scope="col">Estoque</th>
            <th scope="col">Comprada</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pecas as $pec) { ?>
        <tr>
            <th scope="row"><?php echo $pec['descricao']; ?></th>
            <th scope="row"><?php echo $pec["preco"]; ?></th>
            <th scope="row"><?php echo $pec['estoque']; ?></th>
            <td><a href="comprada.php?idPeca=<?php echo $pec["idPeca"]; ?>"><button type="button" class="btn btn-warning btn-sm">Comprada</button></a></td>
            <td><a href="ver_peca.php?idPeca=<?php echo $pec["idPeca"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editar_peca.php?idPeca=<?php echo $pec["idPeca"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo $pec["idPeca"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>