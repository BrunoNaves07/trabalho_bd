<?php
include_once 'DAO/Cliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$cliente = new Cliente(); // Chama a classe de cliente

if( isset($_POST['salvar']) ){
    $cadastrar = $cliente->cadastrar($_POST);
}

?>
<?php echo $funcoes->the_header("Cadastro do Cliente"); ?>
<h1>Cadastro de Cliente</h1>
        <?php 
            if( isset($cadastrar) ) { 
                if($cadastrar['status'] == "ok") {
                    header('Location: clientes.php');
                } else {
                    echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
                }
            }
            
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Primeiro Nome</label>
                <input type="text" class="form-control" id="nome" name="nomeIni">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nome do Meio</label>
                <input type="text" class="form-control" id="nome" name="nomeMeio">
            </div>
            <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        </form>
<?php echo $funcoes->the_footer(); ?>