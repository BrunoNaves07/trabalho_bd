<?php
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$fornecedor = new Fornecedor(); // Chama a classe de cliente

$cnpjFornecedor = $_GET['cnpj'];

if ( !isset($for) ){
    $for = $fornecedor->ver($cnpjFornecedor);
}

if( isset($_POST['salvar']) ){
    $cadastrar = $fornecedor->editar($_POST);
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
            <input type="text" name="cnpj_fornecedor" value="<?php echo $cnpjFornecedor; ?>" hidden>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $for['Fornecedor']['cnpj'] ?>">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Razão Social</label>
                        <input type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo $for['Fornecedor']['razaoSocial'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $for['Fornecedor']['rua'] ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $for['Fornecedor']['numero'] ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $for['Fornecedor']['bairro'] ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $for['Fornecedor']['cep'] ?>">
                    </div>
                </div>
            </div>
            <div class="campo-botao-salvar">
                <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
            </div>
        </form>
<?php echo $funcoes->the_footer(); ?>