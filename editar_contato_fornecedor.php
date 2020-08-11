<?php
include_once 'DAO/ContatoFornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contatoFornecedor = new ContatoFornecedor(); // Chama a classe de cliente

$idContato = $_GET['id'];

if( !isset($cont) ) {
    $cont = $contatoFornecedor->ver($idContato);
}

if( isset($_POST['salvar']) ){
    $editar = $contatoFornecedor->editar($_POST);
}

?>
<?php echo $funcoes->the_header("Editar do Contato de Fornecedor"); ?>
<h1>Editar Contato de Fornecedor</h1>
        <?php 
            if( isset($cadastrar) ) { 
                if($cadastrar['status'] == "ok") {
                    header('Location: contatos_fornecedor.php');
                } else {
                    echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
                }
            }
            
        ?>
        <form method="POST">
            <input type="text" name="id_contato" id="id_contato" value="<?php echo $idContato; ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cont['contato']; ?>">
            </div>
            <div class="campo-botao-salvar">
                <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
            </div>
        </form>
<?php echo $funcoes->the_footer(); ?>