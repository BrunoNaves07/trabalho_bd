<?php
include_once 'DAO/OrdemServico.php';
include_once 'DAO/Servico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();
$servico = new Servico();

$idOs = $_GET['idOrdem'];
$servicos = $servico->index();

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $os->cadastrarSr($_POST);
}

?>

<?php echo $funcoes->the_header("Serviço a ser realizado"); ?>

<h1>Cadastrar Serviço a Ser Realizado</h1>
<?php 
    if( isset($cadastrar) ) { 
        if($cadastrar['status'] == "ok") {
            header('Location: servico_realizado.php?idOrdem='.$cadastrar['idOs']);
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }            
?>
<form method="POST">
<input type="text" name="id_os" value="<?php echo $idOs; ?>" hidden>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">Serviço</label>
            <select class="form-control" id="id_servico" name="id_servico">
                <?php foreach($servicos as $serv) { ?>
                <option value="<?php echo $serv['idServico']; ?>"><?php echo $serv['descricaoServico']; ?></option>  
                <?php } ?>              
            </select>
        </div>
    </div>
</div>
<div class="campo-botao-salvar">
    <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
</div>
</form>

<?php echo $funcoes->the_footer(); ?>