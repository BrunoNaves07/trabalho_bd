<?php
include_once 'DAO/OrdemServico.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();

$idOs = $_GET['idOrdem'];

$realizados = $os->todosServicos($idOs);

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
            <th scope="col">Detalhes</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($realizados as $re) { ?>
        <tr>
            <th scope="row"><?php echo $re['descricaoServico']; ?></th>
            <th scope="row">0</th>
            <td><a href="pecas_sr.php?idServico=<?php echo $re["idServico"]; ?>"><button type="button" class="btn btn-warning btn-sm">Peças Usadas</button></a></td>
            <td><a href="detalhes_sr.php?idOrdem=<?php echo $re["idOs"]; ?>"><button type="button" class="btn btn-success btn-sm">Detalhes</button></a></td>
            <td>
                <form method="POST">
                    <input type="text" name="idDeletar" value="<?php echo "1"; ?>" hidden>
                    <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php echo $funcoes->the_footer(); ?>