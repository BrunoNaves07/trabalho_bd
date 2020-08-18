<?php
include_once 'DAO/Comprada.php';
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$comprada = new Comprada(); 
$fornecedor = new Fornecedor();

$fornecedores = $fornecedor->index();
$idPeca = $_GET['idPeca'];
$buscaPeca = $comprada->index($idPeca);

if ( isset($_POST['salvar']) ) {
    $cadastrar = $comprada->cadastrar($_POST);
}

if(isset($_POST['deletar'])) {
    $delete = $comprada->deletar($_POST['idDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        //
    }
}

?>

<?php echo $funcoes->the_header("Peças"); ?>

<h1>Comprada</h1>
<a href="criar_comprada.php?idPeca=<?php echo $idPeca; ?>"><button type="button" class="btn btn-primary btn-sm">Novo Fornecedor para a peça</button></a>
<hr>
<table class="table">
    <thead>
        <tr>            
            <th scope="col">Fornecedor</th>                        
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($buscaPeca as $pec) { ?>
        <tr>
            <th scope="row"><?php echo $pec['razaoSocial']; ?></th>            
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo $pec["cnpj"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<?php echo $funcoes->the_footer(); ?>