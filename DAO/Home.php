<?php
/**
 * Classe Home
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Home {

    private $con;

    /**
     * Construtor Padrão
     */
    public function __construct() {
        $this->config = new Conectar();
        //$this->con = $this->config->conexao();
        $this->con = mysqli_connect('localhost', 'root', '', 'mydb');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    /**
     * Selecionar quais servicos já foram feitos para determinado cliente
     * com base no CPF
     */
    public function servicoCliente($cpf)
    {
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        $sqlBusca = "SELECT O.descricao, O.dataEntrada, O.dataSaida FROM OrdemServico O 
                     join Veiculos V on (V.placa=O.placa)
                     join Cliente Cl on (Cl.cpf=V.cpf)
                     where Cl.cpf='$cpf'";
        $response = $this->con->query($sqlBusca);

        $resultado = $response->fetch_all(MYSQLI_ASSOC);

        $tabela = '<table class="table">
        <thead>
          <tr>
            <th scope="col">Descrição da OS</th>
            <th scope="col">Data de Entrada</th>
            <th scope="col">Data de Saída</th>
          </tr>
        </thead>
        <tbody>';
        foreach($resultado as $res) { 
        $tabela .= '<tr>
                        <td>'.$res['descricao'].'</td>
                        <td>'.date("d/m/Y", strtotime($res['dataEntrada'])).'</td>
                        <td>'.date("d/m/Y", strtotime($res['dataSaida'])).'</td>
                    </tr>';
        }
        $tabela .= '</tbody>
      </table>';

        return $tabela;

        $this->con->close();
    }

}