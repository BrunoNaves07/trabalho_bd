<?php
include_once 'DAO/Cliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$cliente = new Cliente(); // Chama a classe de cliente

$clientes = $cliente->index(); // Chama a Função index() para a pagina inicial

// 
if(isset($_POST['deletar'])) {
    $delete = $cliente->deletar($_POST['cpfDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        //
    }
}

?>

<?php echo $funcoes->the_header("Clientes"); ?>

<h1>Clientes</h1>
<a href="cadastroCliente.php"><button type="button" class="btn btn-primary btn-sm">Novo Cliente</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">CPF</th>
            <th scope="col">Nome</th>
            <th scope="col">Contatos</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $cli) { ?>
        <tr>
            <th scope="row"><?php echo $cli["cpf"]; ?></th>
            <td><?php echo $cli["nomeIni"] ." ".$cli["nomeMeio"]; ?></td>
            <td><a href="contatos_cliente.php?cpf=<?php echo $cli["cpf"]; ?>"><button class="btn btn-info btn-sm" type="button">Contatos</button></a></td>
            <td><a href="verClientes.php?cpf=<?php echo $cli["cpf"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editarCliente.php?cpf=<?php echo $cli["cpf"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="cpfDeletar" value="<?php echo $cli["cpf"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>