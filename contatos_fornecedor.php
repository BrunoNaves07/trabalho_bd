<?php
include_once 'DAO/ContatoFornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contato = new ContatoFornecedor(); // Chama a classe de cliente

if( isset($_GET['cnpj']) ) {
    $cnpjFornecedor = $_GET['cnpj'];
} else if ( isset($msg['cnpj']) ) {
    $cnpjFornecedor = $msg['cnpj'];
    echo $cnpjFornecedor;
}

if(isset($_POST['deletar'])) {
    $delete = $contato->deletar($_POST['cnpjDeletar']);
    var_dump($delete);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    }
}

$contatos = $contato->index($cnpjFornecedor);

?>

<?php echo $funcoes->the_header("Contatos Cliente"); ?>
<h1>Contatos do Fornecedor</h1>
<hr>
<a href="cadastrar_contato_fornecedor.php?cnpj=<?php echo $cnpjFornecedor; ?>"><button class="btn btn-primary btn-sm" type="button">Novo Contato</button></a>
<hr>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Telefone</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contatos as $contato) { ?>
        <tr>
            <td><?php echo $contato['contato']; ?></td>
            <td><a href="editar_contato_fornecedor.php?id=<?php echo $contato['idContato']; ?>"><button class="btn btn-primary btn-sm" type="button">Editar</button></a></td>
            <td>
                <form method="POST">
                        <input type="text" name="cnpjDeletar" value="<?php echo $contato["idContato"]; ?>" hidden>
                        <button type="submit" class="btn btn-danger btn-sm" name="deletar" onclick="excluir()">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php echo $funcoes->the_footer(); ?>