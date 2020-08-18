<?php
/**
 * Classe Peça
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Peca {

    // Atributos
    private $con;
    // Atributos do model
    private $descricao;    
    private $preco;
    private $estoque;    

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
    public function index() {
        $sqlPeca = "SELECT * FROM peca";

        $resultado = $this->con->query($sqlPeca);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($idPeca) {
        $sqlPeca = "SELECT * FROM peca WHERE idPeca = '$idPeca'";
        $resultado = $this->con->query($sqlPeca);

        return $resultado->fetch_assoc();

        $this->con->close();
    }

    /**
     * Cadastrar
     * @param $dados
     * Cadastra os dados vindo do formulario
     */
    public function cadastrar($dados) {
        $this->descricao  = $dados['descricao'];
        $this->preco = $dados['preco'];
        $this->estoque  = $dados['estoque'];

        $sqlPeca = "INSERT INTO peca (descricao, preco, estoque) VALUES ('$this->descricao', '$this->preco', '$this->estoque')";
        $resultado = $this->con->query($sqlPeca);        
        
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
        $this->descricao  = $dados['descricao'];
        $this->preco = $dados['preco'];
        $this->estoque  = $dados['estoque'];        
        $idPeca = $dados['id_peca'];

        $sqlPeca = "UPDATE peca  SET descricao = '$this->descricao', preco = '$this->preco', estoque = '$this->estoque' WHERE idPeca = '$idPeca'";
        $resultado = $this->con->query($sqlPeca);
        
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
    public function deletar($idPeca) {
        $sqlPeca = "DELETE FROM peca WHERE idPeca = '$idPeca'";
        $resultado = $this->con->query($sqlPeca);
        
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

    /**
     * Show
     */
    public function show($dados) {
        $idPeca = $dados;
        $sqlPeca = "SELECT * FROM peca WHERE idPeca = '$idPeca'";
        $resPeca = $this->con->query($sqlPeca);
        $peca = $resPeca->fetch_assoc();

        $sqlComprada = "SELECT * FROM comprada as C
                          JOIN fornecedor as F ON (C.cnpj = F.cnpj)                          
                          WHERE C.idPeca = '$idPeca'";
        $response = $this->con->query($sqlComprada);
        $forncededores = $response->fetch_all(MYSQLI_ASSOC);

        $dados = [
            'peca' => $peca,
            'fornecedores' => $forncededores,
        ];

        return $dados;

        $this->con->close();
    }
}