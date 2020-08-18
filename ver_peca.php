<?php
include_once 'DAO/Peca.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$peca = new Peca(); // Chama a classe de cliente

$parametro = $_GET['idPeca'];

if(!isset($pec)) 
    $pec = $peca->show($parametro);
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Detalhes da Peça</h1>
<div class="caixa-nome">
    <div class="valor"><strong>Descrição: </strong><?php echo $pec['peca']['descricao']; ?></div>
    <div class="valor"><strong>Preço: </strong><?php echo $pec['peca']["preco"]; ?></div>
    <div class="valor"><strong>Estoque: </strong><?php echo $pec['peca']["estoque"]; ?></div>
    <hr>
    <div class="valor"><h4>Fornecedores:</h4></div>
    <?php foreach($pec['fornecedores'] as $forn) { ?>
    <div class="valor"><strong>Razão Social: </strong><?php echo $forn["razaoSocial"]; ?></div>
    <?php } ?>
</div>        
<?php echo $funcoes->the_footer(); ?>