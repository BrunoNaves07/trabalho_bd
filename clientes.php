<?php
include_once 'DAO/Cliente.php';
$cliente = new Cliente(); // Chama a classe de cliente

$clientes = $cliente->index(); // Chama a Função index() para a pagina inicial

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Clientes</title>
  </head>
  <body>
        <div class="container-fluid">
            <h1>Clientes</h1>
            <a href="cadastroCliente.php"><button type="button" class="btn btn-primary">Novo Cliente</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ver</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cli) { ?>
                    <tr>
                        <th scope="row"><?php echo $cli["cpf"]; ?></th>
                        <td><?php echo $cli["nomeIni"] ." ".$cli["nomeMeio"]; ?></td>
                        <td><a href="verClientes.php?cpf=<?php echo $cli["cpf"]; ?>"><button type="button" class="btn btn-success">Ver</button></a></td>
                        <td><button type="button" class="btn btn-primary">Editar</button></td>
                        <td><button type="button" class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>