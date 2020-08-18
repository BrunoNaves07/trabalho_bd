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

// Verifica se o botão foi clicado
if ( isset($_POST['salvar']) ) {
    $cadastrar = $veiculo->cadastrar($_POST);
}

?>

<?php echo $funcoes->the_header("Clientes"); ?>

<h1>Cadastrar Veiculo</h1>
<?php 
    if( isset($cadastrar) ) { 
        if($cadastrar['status'] == "ok") {
            header('Location: veiculos.php?cpf='.$cpfCliente);
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }            
?>
<form method="POST">
<input type="text" name="cpf_cliente" value="<?php echo $cpfCliente; ?>" hidden>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Placa</label>
            <input type="text" class="form-control" id="placa" name="placa">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Marca</label>
            <select class="form-control" id="marca" name="marca">
                <option>Chevrolet</option>
                <option>Volkswagen</option>
                <option>Fiat</option>
                <option>Renault</option>
                <option>Ford</option>
                <option>Toyota</option>
                <option>Hyundai</option>
                <option>Jeep</option>
                <option>Honda</option>
                <option>Nissan</option>
                <option>Citroën</option>
                <option>Mitsubishi</option>
                <option>Peugeot</option>
                <option>Chery</option>
                <option>BMW</option>
                <option>Mercedes-Benz</option>
                <option>Kia</option>
                <option>Audi</option>
                <option>Volvo</option>
                <option>Land Rover</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Ano</label>
            <input type="number" class="form-control" id="ano" name="ano" min="1900" max="2099" step="1">
        </div>
    </div>
</div>
<div class="campo-botao-salvar">
    <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
</div>
</form>

<?php echo $funcoes->the_footer(); ?>