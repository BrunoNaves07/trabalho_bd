<?php
include_once 'DAO/Cliente.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$cliente = new Cliente(); // Chama a classe de cliente

$parametro = $_GET['cpf'];

if(!isset($cli)) 
    $cli = $cliente->ver($parametro);
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Detalhes do Cliente</h1>
<div class="caixa-nome">
    <div class="valor"><strong>CPF: </strong><?php echo $cli['cliente']["cpf"]; ?></div>
    <div class="valor"><strong>Nome: </strong><?php echo $cli['cliente']["nomeIni"] . " " . $cli['cliente']["nomeMeio"]; ?></div>
    <hr>
    <div class="valor"><strong>Contatos: </strong></div>
    <?php
        $i = 1;
        foreach($cli['contatos'] as $contato) { 
    ?>
    <div class="telefones"><?php echo '<strong>' . $i .'</strong> - '. $contato['contato']; ?></div>
    <?php 
        $i++;    
        } 
    ?>
</div>        
<?php echo $funcoes->the_footer(); ?>