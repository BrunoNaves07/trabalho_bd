<?php
include_once 'DAO/Servico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$servico = new Servico();

$idServico = $_GET['idServico'];
$serv = $servico->ver($idServico);

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $servico->editar($_POST);
}

?>

<?php echo $funcoes->the_header("Serviço"); ?>

<h1>Cadastrar Serviço</h1>
<?php 
    if( isset($cadastrar) ) { 
        if($cadastrar['status'] == "ok") {
            header('Location: servicos.php');
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }            
?>
<form method="POST">
<input type="text" name="id_servico" value="<?php echo $idServico; ?>" hidden>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">Descricao</label>
            <input type="text" class="form-control" id="descricao_servico" name="descricao_servico" value="<?php echo $serv['descricaoServico']; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputPassword1">Preço</label>
            <input type="text" class="form-control" id="valor_servico" name="valor_servico" value="<?php echo $serv['valorServico']; ?>">
        </div>
    </div>
</div>
<div class="campo-botao-salvar">
    <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
</div>
</form>

<?php echo $funcoes->the_footer(); ?>