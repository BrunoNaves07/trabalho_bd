<?php
/**
 * Classe Veiculo
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Veiculo {

    // Atributos
    private $con;
    // Atributos do model
    private $placa;    
    private $marca;
    private $ano;
    private $modelo;
    private $cpf;

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
     * Index
     * Lista todos os dados
     */
    public function index($cpfCliente) {
        $sqlVeiculo = "SELECT * FROM veiculos WHERE cpf = '$cpfCliente'";

        $resultado = $this->con->query($sqlVeiculo);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($placa) {
        $sqlVeiculo = "SELECT * FROM veiculos WHERE placa = '$placa'";
        $resultado = $this->con->query($sqlVeiculo);

        return $resultado->fetch_assoc();

        $this->con->close();
    }

    /**
     * Cadastrar
     * @param $dados
     * Cadastra os dados vindo do formulario
     */
    public function cadastrar($dados) {
        $this->placa  = $dados['placa'];
        $this->modelo = $dados['modelo'];
        $this->marca  = $dados['marca'];
        $this->ano    = $dados['ano'];
        $this->cpf    = $dados['cpf_cliente'];

        $sqlVeiculo = "INSERT INTO veiculos (placa, modelo, marca, ano, cpf) VALUES ('$this->placa', '$this->modelo', '$this->marca', '$this->ano', '$this->cpf')";
        $resultado = $this->con->query($sqlVeiculo);
        
        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro inserido com sucesso!",
                    ];
        } else {
            return  $msg = [
                        "status" => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                    ];
        }

        $this->con->close();
    }

    /**
     * Editar
     * @param $id, $dados
     * Edita os dados vindo do formulário
     */
    public function editar($dados) {                
        $this->placa  = $dados['placa'];
        $this->modelo = $dados['modelo'];
        $this->marca  = $dados['marca'];
        $this->ano    = $dados['ano'];
        $this->cpf    = $dados['cpf_cliente'];
        $placaVeiculo = $dados['placa_veiculo'];
        

        $sqlVeiculo = "UPDATE veiculos  SET placa = '$this->placa', modelo = '$this->modelo', marca = '$this->marca', ano = '$this->ano', cpf = '$this->cpf' WHERE placa = '$placaVeiculo'";
        $resultado = $this->con->query($sqlVeiculo);
        
        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro editado com sucesso!",
                    ];
        } else {
            return  $msg = [
                        "status" => "erro",
                        "mensagem" => "Erro ao editar Registro!" . $resultado . " - " . mysqli_error($this->con),
                    ];
        }

        $this->con->close();
    }

    /**
     * Deletar
     * @param $id
     * Deleta o registro
     */
    public function deletar($placa) {
        $sqlVeiculo = "DELETE FROM veiculos WHERE placa = '$placa'";
        $resultado = $this->con->query($sqlVeiculo);
        
        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro deletado com sucesso!",
                    ];
        } else {
            return  $msg = [
                        "status" => "erro",
                        "mensagem" => "Erro ao deletar Registro!" . $resultado . " - " . mysqli_error($this->con),
                    ];
        }

        $this->con->close();
    }

    /**
     * Pesquisar
     * @param $parametro
     * Faz a busca na tabela
     */
    public function pesquisar($parametro) {
        //
    }
}