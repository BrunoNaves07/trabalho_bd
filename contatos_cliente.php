<?php
include_once 'DAO/ContatoCliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contato = new ContatoCliente(); // Chama a classe de cliente

if( isset($_GET['cpf']) ) {
    $cpfCliente = $_GET['cpf'];
} else if ( isset($msg['cpf']) ) {
    $cpfCliente = $msg['cpf'];
    echo $cpfCliente;
}

if(isset($_POST['deletar'])) {
    $delete = $contato->deletar($_POST['cpfDeletar']);
    var_dump($delete);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    }
}

$contatos = $contato->index($cpfCliente);

?>

<?php echo $funcoes->the_header("Contatos Cliente"); ?>
<h1>Contatos do Cliente</h1>
<hr>
<a href="cadastrar_contato_cliente.php?cpf=<?php echo $cpfCliente; ?>"><button class="btn btn-primary btn-sm" type="button">Novo Contato</button></a>
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
            <td><a href="editar_contato_cliente.php?id=<?php echo $contato['idContato']; ?>"><button class="btn btn-primary btn-sm" type="button">Editar</button></a></td>
            <td>
                <form method="POST">
                        <input type="text" name="cpfDeletar" value="<?php echo $contato["idContato"]; ?>" hidden>
                        <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php echo $funcoes->the_footer(); ?>