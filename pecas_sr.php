<?php
include_once 'DAO/OrdemServico.php';
include_once 'DAO/Peca.php';
include_once 'config/funcoes.php';
$funcoes = new Funcoes();
$os = new OrdemServico();
$peca = new Peca();

$idServico = $_GET['idServico'];
$servico = $os->servicos($idServico);
$pecas = $peca->index();
$itens = $os->pecasUsadas($idServico);


if( isset($_POST['salvar']) ) {
    $cadastrar = $os->cadastrarPeca($_POST);
}

if( isset($cadastrar) ) {
    if($cadastrar['status'] == "ok") {
        header('Location: pecas_sr.php?idServico='.$cadastrar['idServico']);
    } else {
        echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
    }
}

if ( isset($_POST['idPeca']) ) {
    $deletar = $os->deletarItem($_POST);
}

if ( isset($deletar) ) {
    if($deletar['status'] == "ok") {
        header('Location: pecas_sr.php?idServico='.$deletar['idServico']);
    } else {
        echo '<div class="alert alert-danger" role="alert">'.$cadastrar["mensagem"].'</div>';
    }
}

?>
<?php echo $funcoes->the_header("Serviços Realizados"); ?>

<h1>Peças Usadas no Serviço</h1>

<div class="caixa-peca">
    <div class="valor"><strong>Descrição do Serviço: </strong><?php echo $servico['descricaoServico']; ?></div>
    <div class="valor"><strong>Preço do Serviço: </strong><?php echo $servico['valorServico']; ?></div>
</div>
<hr>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
  Incluir Peça
</button>
<hr>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Descrição</th>
      <th scope="col">Preço</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($itens as $item) { ?>
    <tr>
      <th scope="row"><?php echo $item['descricao']; ?></th>
      <td><?php echo $item['valorPecas']; ?></td>      
      <td>
        <form method="POST">
            <input type="text" name="idServico" value="<?php echo $item["idServico"]; ?>" hidden>
            <input type="text" name="idPeca" value="<?php echo $item["idPeca"]; ?>" hidden>
            <button type="submit" class="btn btn-danger btn-sm" name="deletar">Excluir</button>
        </form>
      </td>
    </tr>
      <?php } ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inlcuir Peça</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <input type="text" name="id_servico" value="<?php echo $idServico; ?>" hidden>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Peça</label>
                    <select class="form-control" id="id_peca" name="id_peca">
                        <?php foreach($pecas as $pec) { ?>
                        <option value="<?php echo $pec['idPeca']; ?>"><?php echo $pec['descricao']; ?></option>  
                        <?php } ?>              
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" min="0">
                </div>
            </div>
        </div>
        <div class="campo-botao-salvar">
            <button type="submit" class="btn btn-primary botao-salvar" name="salvar">Salvar</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

<?php echo $funcoes->the_footer(); ?>