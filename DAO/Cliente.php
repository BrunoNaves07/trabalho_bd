<?php
/**
 * Classe Cliente
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Cliente {

    // Atributos
    private $config;
    private $con;
    // Atributos do model
    private $cpf;
    private $nomeIni;
    private $nomeMeio;

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
        $sqlCliente = 'SELECT * FROM cliente';

        $resultado = $this->con->query($sqlCliente);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($cpf) {
        $sqlCliente = 'SELECT * FROM cliente WHERE cpf = '. $cpf;

        $resultado = $this->con->query($sqlCliente);
        return $resultado->fetch_assoc();
    
        $this->con->close();
    }

    /**
     * Cadastrar
     * @param $dados
     * Cadastra os dados vindo do formulario
     */
    public function cadastrar($dados) {

        $cpf = $dados['cpf'];
        $cpf      = trim($cpf);
        $cpf      = str_replace(".", "", $cpf);
        $cpf      = str_replace("-", "", $cpf);
        $this->cpf = $cpf;
        
        $this->nomeIni  = $dados['nomeIni'];
        $this->nomeMeio = $dados['nomeMeio'];

        $sqlCliente = "INSERT INTO cliente (cpf, nomeIni, nomeMeio) VALUE('$this->cpf','$this->nomeIni','$this->nomeMeio')";
        $resultado = $this->con->query($sqlCliente);
        
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
    public function editar($id, $dados) {
        //
    }

    /**
     * Deletar
     * @param $id
     * Deleta o registro
     */
    public function deletar($id) {
        //
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