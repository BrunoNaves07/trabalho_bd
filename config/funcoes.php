<?php

class Funcoes {
    public function the_header($titulo) {
        $header = '<!doctype html>
                    <html lang="pt_BR">
                    <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <link rel="stylesheet" href="css/style.css">
                        <!-- Bootstrap CSS -->
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
                    
                        <title>Sistema de Oficinas - '.$titulo.'</title>
                    </head>
                    <body>
                        <div class="jumbotron" id="menu">
                            <div class="container-fluid">
                                '.$this->menu().'
                            </div>
                        </div>
                        <div class="container" id="container">';
        return $header;
    }

    public function the_footer() {
        $footer = '</div>
                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
                </body>
                </html>';
        return $footer;
    }

    public function menu() {
        $menu = '<nav class="navbar navbar-expand-lg navbar-light bg-oficina">
        <a class="navbar-brand" href="#">Oficina</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Início <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clientes.php">Clientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Veiculos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Fornecedores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Peças</a>
            </li>

          </ul>
          
        </div>
      </nav>';

      return $menu;
    }
}