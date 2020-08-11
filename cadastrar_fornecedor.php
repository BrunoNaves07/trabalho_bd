<?php
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$fornecedor = new Fornecedor(); // Chama a classe de cliente

if( isset($_POST['salvar']) ){
    $cadastrar = $fornecedor->cadastrar($_POST);
}

?>
<?php echo $funcoes->the_header("Cadastro do Fornecedor"); ?>
<h1>Cadastro de Fornecedor</h1>
        <?php 
            if( isset($cadastrar) ) { 
                if($cadastrar['status'] == "ok") {
                    header('Location: fornecedores.php');
                } else {
                    echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
                }
            }
            
        ?>
        <form method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Razão Social</label>
                        <input type="text" class="form-control" id="razao_social" name="razao_social">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep">
                    </div>
                </div>
            </div>
            <div class="campo-botao-salvar">
                <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
            </div>
        </form>
<?php echo $funcoes->the_footer(); ?>