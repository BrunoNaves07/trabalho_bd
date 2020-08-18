<?php
include_once 'DAO/Peca.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$peca = new Peca(); 

$idPeca = $_GET['idPeca'];
$pec = $peca->ver($idPeca);

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $peca->editar($_POST);
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
<input type="text" name="id_peca" value="<?php echo $pec['idPeca']; ?>" hidden>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">Descricao</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $pec['descricao']; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Preço</label>
            <input type="text" class="form-control" id="preco" name="preco" value="<?php echo $pec['preco']; ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Estoque</label>
            <input type="number" class="form-control" id="estoque" name="estoque" min="0" value="<?php echo $pec['estoque']; ?>">
        </div>
    </div>
</div>
<div class="campo-botao-salvar">
    <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
</div>
</form>

<?php echo $funcoes->the_footer(); ?>