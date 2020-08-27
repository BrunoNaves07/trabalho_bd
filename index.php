<?php
include_once 'DAO/Home.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$home = new Home();

if (isset($_POST['pesquisaServico'])) {
    $pesquisar = $home->servicoCliente($_POST['cpf']);    
}

if (isset($_POST['pesquisaPlaca'])) {
    $pesquisar = $home->placa($_POST['placa']);    
}

?>

<?php echo $funcoes->the_header("Serviço"); ?>

<h1>Tela Inicial</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pesquisar OS pelo CPF do Cliente</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">CPF Cliente</label>
                        <input type="text" class="form-control form-control-sm" id="cpf" name="cpf" placeholder="CPF">                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" name="pesquisaServico">Pesquisar</button> 
                </form>
            </div>
        </div>  
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Procurar Veiculo</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Placa</label>
                        <input type="text" class="form-control form-control-sm" id="placa" name="placa" placeholder="Placa">                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" name="pesquisaPlaca">Pesquisar</button> 
                </form>
            </div>
        </div>  
    </div>
</div>
<?php
    if (isset($pesquisar)) {
        echo $pesquisar;
    }
?>

<?php echo $funcoes->the_footer(); ?>