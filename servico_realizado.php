<?php
include_once 'DAO/OrdemServico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();

$idOs = $_GET['idOrdem'];

$realizados = $os->todosServicos($idOs);

if(isset($_POST['deletar'])) {    
    $deletar = $os->deletarServicoRealizado($_POST);
    if ($deletar['status'] == "ok") {
        header("Refresh:0");
    }
}

?>

<?php echo $funcoes->the_header("Serviços Realizados"); ?>

<h1>Serviços Realizados</h1>
<a href="cadastrar_sr.php?idOrdem=<?php echo $idOs; ?>"><button type="button" class="btn btn-primary btn-sm">Novo Serviço Realizado</button></a>
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Descrição Serviço</th>
            <th scope="col">Preço</th>
            <th scope="col">Peças</th>            
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($realizados as $re) { ?>
        <tr>
            <th scope="row"><?php echo $re['descricaoServico']; ?></th>
            <th scope="row"><?php echo $re['valorServico']; ?></th>
            <td><a href="pecas_sr.php?idServico=<?php echo $re["idServico"]; ?>"><button type="button" class="btn btn-warning btn-sm">Peças Usadas</button></a></td>            
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo $re["idServico"]; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php echo $funcoes->the_footer(); ?>