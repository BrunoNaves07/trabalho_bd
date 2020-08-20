<?php
include_once 'DAO/Servico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$servico = new Servico(); // Chama a classe de cliente

$parametro = $_GET['idServico'];

if(!isset($serv)) 
    $serv = $servico->ver($parametro);
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Detalhes do Serviço</h1>
<div class="caixa-nome">
    <div class="valor"><strong>Descrição: </strong><?php echo $serv['descricaoServico']; ?></div>
    <div class="valor"><strong>Preço: </strong><?php echo $serv["valorServico"]; ?></div>    
    <hr>
</div>        
<?php echo $funcoes->the_footer(); ?>