<?php
include_once 'DAO/ContatoCliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contatoCliente = new ContatoCliente(); // Chama a classe de cliente

$cpfCliente = $_GET['cpf'];

echo $cpfCliente;

if( isset($_POST['salvar']) ){
    $cadastrar = $contatoCliente->cadastrar($_POST);
}

?>
<?php echo $funcoes->the_header("Cadastro do Cliente"); ?>
<h1>Cadastro de Contato Cliente</h1>
        <?php 
            if( isset($cadastrar) ) { 
                if($cadastrar['status'] == "ok") {
                    header('Location: contatos_cliente.php');
                } else {
                    echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
                }
            }
            
        ?>
        <form method="POST">
            <input type="text" name="cpf_cliente" id="cpf_cliente" value="<?php echo $cpfCliente; ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        </form>
<?php echo $funcoes->the_footer(); ?>