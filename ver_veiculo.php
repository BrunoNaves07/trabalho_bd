<?php
include_once 'DAO/Veiculo.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$veiculo = new Veiculo(); // Chama a classe de cliente

$parametro = $_GET['placa'];

if(!isset($veic)) 
    $veic = $veiculo->ver($parametro);
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Detalhes do Veículo</h1>
<div class="caixa-nome">
    <div class="valor"><strong>Placa: </strong><?php echo $veic['placa']; ?></div>
    <div class="valor"><strong>Marca: </strong><?php echo $veic["marca"]; ?></div>
    <div class="valor"><strong>Modelo: </strong><?php echo $veic["modelo"]; ?></div>
    <div class="valor"><strong>Ano: </strong><?php echo $veic["ano"]; ?></div>
</div>        
<?php echo $funcoes->the_footer(); ?>