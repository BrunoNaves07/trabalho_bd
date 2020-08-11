<?php
include_once 'DAO/Cliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$cliente = new Cliente(); // Chama a classe de cliente

$cpfCliente = $_GET['cpf'];

if(!isset($cli)) {
    $cli = $cliente->ver($cpfCliente);
}

if( isset($_POST['salvar']) ){
    $editar = $cliente->editar($_POST);
}

?>
<?php echo $funcoes->the_header("Editar Cliente"); ?>

<h1>Editar Cliente</h1>
<?php 
    if( isset($editar) ) { 
        if($editar['status'] == "ok") {
            header('Location: clientes.php');
        } else {
            echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
        }
    }
    
?>
<form method="POST">
    <input type="text" name="cpf_cliente" value="<?php echo $cpfCliente; ?>" hidden>
    <div class="form-group">
        <label for="exampleInputEmail1">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cli['cliente']['cpf']; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Primeiro Nome</label>
        <input type="text" class="form-control" id="nome" name="nomeIni" value="<?php echo $cli['cliente']['nomeIni']; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nome do Meio</label>
        <input type="text" class="form-control" id="nome" name="nomeMeio" value="<?php echo $cli['cliente']['nomeMeio']; ?>">
    </div>
    <div class="campo-botao-salvar">
        <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
    </div>
</form>
<?php echo $funcoes->the_footer(); ?>