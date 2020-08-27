<?php
include_once 'DAO/Home.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$home = new Home();

if (isset($_POST['pesquisaServico'])) {
    $pesquisar = $home->servicoCliente($_POST['cpf']);    
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
        <?php
            if (isset($pesquisar)) {
                echo $pesquisar;
            }
        ?>
    </div>
</div>

<?php echo $funcoes->the_footer(); ?>