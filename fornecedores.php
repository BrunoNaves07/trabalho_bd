<?php
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$fornecedor = new Fornecedor(); // Chama a classe de cliente

$fornecedores = $fornecedor->index(); // Chama a Função index() para a pagina inicial

if(isset($_POST['deletar'])) {
    $delete = $fornecedor->deletar($_POST['cnpjDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    }
}

?>

<?php echo $funcoes->the_header("Fornecedores"); ?>
<h1>Fornecedores</h1>
<a href="cadastrar_fornecedor.php"><button type="button" class="btn btn-primary btn-sm">Novo Fornecedor</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">CNPJ</th>
            <th scope="col">Razão Social</th>
            <th scope="col">Contatos</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($fornecedores as $for) { ?>
        <tr>
            <th scope="row"><?php echo $for["cnpj"]; ?></th>
            <td><?php echo $for["razaoSocial"]; ?></td>
            <td><a href="contatos_cliente.php?cnpj=<?php echo $for["cnpj"]; ?>"><button class="btn btn-info btn-sm" type="button">Contatos</button></a></td>
            <td><a href="ver_fornecedor.php?cnpj=<?php echo $for["cnpj"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editar_fornecedor.php?cnpj=<?php echo $for["cnpj"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="cnpjDeletar" value="<?php echo $for["cnpj"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>