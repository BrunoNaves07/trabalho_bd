<?php
include_once 'DAO/Fornecedor.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$fornecedor = new Fornecedor(); // Chama a classe de cliente

$parametro = $_GET['cnpj'];

if(!isset($for)) 
    $for = $fornecedor->ver($parametro);
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Detalhes do Cliente</h1>
<div class="caixa-nome">
    <div class="valor"><strong>CPF: </strong><?php echo $for['Fornecedor']["cnpj"]; ?></div>
    <div class="valor"><strong>Nome: </strong><?php echo $for['Fornecedor']["razaoSocial"]; ?></div>
    <hr>
    <div class="valor"><strong>Contatos: </strong></div>
    <?php
        $i = 1;
        foreach($for['contatos'] as $contato) { 
    ?>
    <div class="telefones"><?php echo '<strong>' . $i .'</strong> - '. $contato['contato']; ?></div>
    <?php 
        $i++;    
        } 
    ?>
</div>        
<?php echo $funcoes->the_footer(); ?>