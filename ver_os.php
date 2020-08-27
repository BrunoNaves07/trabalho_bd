<?php
include_once 'DAO/OrdemServico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();

$parametro = $_GET['idOrdem'];

if(!isset($ordem)) 
    $ordem = $os->detalhes($parametro);    
?>

<?php echo $funcoes->the_header("Detalhes do Cliente"); ?>
<h1>Ordem de Serviço</h1>
<hr>
<div class="caixa-nome">    
    <div class="row">
        <div class="col">
            <div class="valor"><strong>ID OS: </strong><?php echo $ordem['dadosOrdem']["idOS"]; ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Data de Entrada: </strong><?php echo date('d/m/Y', strtotime($ordem['dadosOrdem']['dataEntrada'])); ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Data de Saída: </strong><?php echo date('d/m/Y', strtotime($ordem['dadosOrdem']['dataSaida'])); ?></div>
        </div>
    </div>    
    <hr>
    <div class="valor" style="margin-bottom: 10px; color: #555; font-size: 12px;"><strong>Veiculo / Cliente </strong></div>
    <div class="row" style="border: 1px solid #ededed; margin-bottom: 5px">
        <div class="col">
            <div class="valor"><strong>Placa: </strong><?php echo $ordem['dadosOrdem']["placa"]; ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Marca: </strong><?php echo $ordem['dadosOrdem']["marca"]; ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Modelo: </strong><?php echo $ordem['dadosOrdem']['modelo']; ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Ano: </strong><?php echo $ordem['dadosOrdem']['ano']; ?></div>
        </div>
    </div>
    <div class="row" style="border: 1px solid #ededed; margin-bottom: 5px">
        <div class="col">
            <div class="valor"><strong>Cliente: </strong><?php echo $ordem['dadosOrdem']["nomeIni"] . ' ' . $ordem['dadosOrdem']['nomeMeio']; ?></div>
        </div>
    </div>
    <hr>
    <h1 id="total"></h1>
    <hr>
    <div class="valor" style="margin-bottom: 10px; color: #555; font-size: 12px;"><strong>Serviços / Peças Usadas </strong></div>
    <?php foreach($ordem['servicos'] as $serv) { ?>
    <div class="row" style="border: 1px solid #ededed; margin-bottom: 5px; background-color: rgb(0, 48, 80); color: #fff">
        <div class="col">
            <div class="valor"><strong>Descrição Serviço: </strong><?php echo $serv['descricaoServico']; ?></div>
        </div>
        <div class="col">
            <div class="valor"><strong>Valor Serviço: </strong><?php echo $serv['valorServico']; ?></div>
            <?php $valor = 0; ?>
        </div>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Peça</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor</th>                
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($ordem['pecas'] as $peca) { 
                    if($peca['idServico'] == $serv['idServico']) {
            ?>
            <tr>
                <th scope="row"><?php echo $peca['descricao']; ?></th>
                <td><?php echo $peca['quantidadeVendida']; ?></td>
                <td><?php echo $peca['valorPecas']; ?></td>  
                <?php $valor += $peca['valorPecas']; ?>              
            </tr>
            <?php } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td style="text-align: right;"><strong>Total</strong></td>
                <td style="color: red;"><strong><?php echo $valor; ?></strong></td>
            </tr>        
        </tfoot>
    </table>    
    <hr>
    <?php } ?>  
</div>        

<?php echo $funcoes->the_footer(); ?>