<?php
include_once 'DAO/ContatoCliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$contatoCliente = new ContatoCliente(); // Chama a classe de cliente

$idContato = $_GET['id'];

if( !isset($cont) ) {
    $cont = $contatoCliente->ver($idContato);
}

if( isset($_POST['salvar']) ){
    $editar = $contatoCliente->editar($_POST);
}

?>
<?php echo $funcoes->the_header("Cadastro do Cliente"); ?>
<h1>Cadastro de Contato Cliente</h1>
        <?php
            if (isset($editar['status'])) {
                echo '<div class="alert alert-danger" role="alert">
                      '.$editar['mensagem'].'
                      </div>';
            }
        ?>
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
            <input type="text" name="id_contato" id="id_contato" value="<?php echo $idContato; ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cont['contato']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        </form>
<?php echo $funcoes->the_footer(); ?>