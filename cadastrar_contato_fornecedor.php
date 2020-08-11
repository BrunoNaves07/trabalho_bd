<?php
include_once 'DAO/ContatoFornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contatoFornecedor = new ContatoFornecedor(); // Chama a classe de cliente

$cnpjFornecedor = $_GET['cnpj'];

if( isset($_POST['salvar']) ){
    $cadastrar = $contatoFornecedor->cadastrar($_POST);
}

?>
<?php echo $funcoes->the_header("Cadastro do Contato de Fornecedor"); ?>
<h1>Cadastro do Contato de Fornecedor</h1>
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
            <input type="text" name="cnpj_fornecedor" id="cnpj_fornecedor" value="<?php echo $cnpjFornecedor; ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="campo-botao-salvar">
                <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
            </div>
        </form>
<?php echo $funcoes->the_footer(); ?>