<?php
include_once 'DAO/OrdemServico.php';
include_once 'DAO/Veiculo.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();
$veiculo = new Veiculo();

$veiculos = $veiculo->veiculos();

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $os->cadastrar($_POST);
}

?>

<?php echo $funcoes->the_header("Serviço"); ?>

<h1>Cadastrar Ordem de Serviço</h1>
<?php 
    if( isset($cadastrar) ) { 
        if($cadastrar['status'] == "ok") {
            header('Location: ordemServicos.php');
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }            
?>
<form method="POST">
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">Descricao</label>
            <input type="text" class="form-control" id="descricao_os" name="descricao_os">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Data de Entrada</label>
            <input type="date" class="form-control" id="data_entrada" name="data_entrada">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Data de Saída</label>
            <input type="date" class="form-control" id="data_saida" name="data_saida">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Veículo / Cliente</label>
            <select class="form-control" id="placa" name="placa">
                <?php foreach($veiculos as $veic) { ?>
                <option value="<?php echo $veic['placa']; ?>"><?php echo $veic['modelo'] . " / " . $veic['nomeIni']; ?></option>
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