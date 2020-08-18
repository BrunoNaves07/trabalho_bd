<?php
include_once 'DAO/Veiculo.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$veiculo = new Veiculo(); // Chama a classe de cliente

if( isset($_GET['cpf']) ) {
    $cpfCliente = $_GET['cpf'];
} else {
    header("Location: clientes.php");
}

$veiculos = $veiculo->index($cpfCliente); // Chama a Função index() para a pagina inicial

// 
if(isset($_POST['deletar'])) {
    $delete = $veiculo->deletar($_POST['placaDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        //
    }
}

?>

<?php echo $funcoes->the_header("Veiculos"); ?>

<h1>Veiculos</h1>
<a href="cadastrar_veiculo.php?cpf=<?php echo $cpfCliente; ?>"><button type="button" class="btn btn-primary btn-sm">Novo Veiculo</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Veiculo</th> 
            <th scope="col">Placa</th>                        
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($veiculos as $veic) { ?>
        <tr>
            <th scope="row"><?php echo $veic['marca'] . " / " . $veic["modelo"]; ?></th>
            <th scope="row"><?php echo $veic["placa"]; ?></th>
            <td><a href="ver_veiculo.php?placa=<?php echo $veic["placa"]; ?>"><button type="button" class="btn btn-success btn-sm">Ver</button></a></td>
            <td><a href="editar_veiculo.php?placa=<?php echo $veic["placa"]; ?>"><button type="button" class="btn btn-primary btn-sm">Editar</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="placaDeletar" value="<?php echo $veic["placa"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $funcoes->the_footer(); ?>