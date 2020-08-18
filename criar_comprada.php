<?php
include_once 'DAO/Comprada.php';
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$comprada = new Comprada(); 
$fornecedor = new Fornecedor();

$fornecedores = $fornecedor->index();

$buscaPeca = $comprada->index($_GET['idPeca']);

if ( isset($_POST['salvar']) ) {
    $cadastrar = $comprada->cadastrar($_POST);
}

if(isset($_POST['deletar'])) {
    $delete = $peca->deletar($_POST['idDeletar']);
    if ($delete['status'] == "ok") {
        header("Refresh:0");
    } else {
        //
    }
}

?>

<?php echo $funcoes->the_header("Peças"); ?>

<h1>Criar Relacionamento Peça Fornecedor</h1>
<?php 
    if( isset($cadastrar) ) { 
        if($cadastrar['status'] == "ok") {
            header('Location: pecas.php');
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }            
?>
<form method="POST">
    <input type="text" name="id_peca" value="<?php echo $_GET['idPeca']; ?>" hidden>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Fornecedor</label>
        <select class="form-control" id="cnpjFornecedor" name="cnpjFornecedor">
        <?php foreach($fornecedores as $for) { ?>
        <option value="<?php echo $for['cnpj']; ?>"><?php echo $for['razaoSocial']; ?></option>
        <?php } ?>
        </select>
    </div>
    <div class="campo-botao-salvar">
        <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
    </div>
</form>


<?php echo $funcoes->the_footer(); ?>