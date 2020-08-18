<?php
/**
 * Classe Comprada
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Comprada {
    // Atributos
    private $con;
    // Atributos do model
    private $idPeca;    
    private $cnpjFornecedor;   

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
    public function index($idPeca) {
        $sqlPeca = "SELECT * FROM comprada as C
                    INNER JOIN fornecedor as F ON C.cnpj = F.cnpj 
                    WHERE idPeca = '$idPeca'";

        $resultado = $this->con->query($sqlPeca);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * cadastrar
     * Relaciona Fornecedor com Peça
     */
    public function cadastrar($dados) {

        $this->idPeca = $dados['id_peca'];    
        $this->cnpjFornecedor = $dados['cnpjFornecedor']; 

        $sqlComprada = "INSERT INTO comprada (idPeca, cnpj) VALUES ('$this->idPeca', '$this->cnpjFornecedor')";
        $resultado = $this->con->query($sqlComprada);

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
     */
    public function deletar($dados) {
        $cnpj = $dados;
        $sqlComprada = "DELETE FROM comprada WHERE cnpj = '$cnpj'";
        $resultado = $this->con->query($sqlComprada);

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
}