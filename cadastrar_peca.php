<?php
include_once 'DAO/Peca.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$peca = new Peca();

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $peca->cadastrar($_POST);
}

?>

<?php echo $funcoes->the_header("Peças"); ?>

<h1>Cadastrar Peça</h1>
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
<input type="text" name="cpf_cliente" value="<?php echo $cpfCliente; ?>" hidden>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">Descricao</label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Preço</label>
            <input type="text" class="form-control" id="preco" name="preco">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Estoque</label>
            <input type="number" class="form-control" id="estoque" name="estoque" min="0">
        </div>
    </div>
</div>
<div class="campo-botao-salvar">
    <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
</div>
</form>

<?php echo $funcoes->the_footer(); ?>