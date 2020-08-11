<?php
/**
 * Classe Fornecedor
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Fornecedor {

    // Atributos
    private $config;
    private $con;
    // Atributos do model
    private $cnpj;
    private $razaSocial;
    private $rua;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;

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
        $sqlCliente = 'SELECT * FROM fornecedor';

        $resultado = $this->con->query($sqlCliente);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($cnpj) {
        //
    }

    /**
     * Cadastrar
     * @param $dados
     * Cadastra os dados vindo do formulario
     */
    public function cadastrar($dados) {
        
        $cnpj = $dados['cnpj'];
        $cnpj             = trim($cnpj);
        $cnpj             = str_replace(".", "", $cnpj);
        $cnpj             = str_replace("-", "", $cnpj);
        $cnpj             = str_replace("/", "", $cnpj);
        $this->cnpj       = $cnpj;
        $this->razaoSocial = $dados['razao_social'];
        $this->rua        = $dados['rua'];
        $this->numero     = $dados['numero'];
        $this->bairro     = $dados['bairro'];
        $this->cep        = $dados['cep'];
        $this->cidade     = $dados['cidade'];

        $sqlFornecedor = "INSERT INTO fornecedor (cnpj, razaoSocial, rua, numero, bairro, cep, cidade) VALUE('$this->cnpj','$this->razaoSocial','$this->rua','$this->numero','$this->bairro','$this->cep','$this->cidade')";
        $resultado = $this->con->query($sqlFornecedor);
        
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
        //        

    }

    /**
     * Deletar
     * @param $id
     * Deleta o registro
     */
    public function deletar($cpf) {
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
