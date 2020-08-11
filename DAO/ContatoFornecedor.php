<?php
/**
 * Classe ContatoFornecedor
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class ContatoFornecedor {

    // Atributos
    private $con;
    private $cnpjFornecedor;
    private $telefone;

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
    public function index($cnpj) {
        $sqlFornecedor = 'SELECT * FROM contatoFor WHERE cnpj = '. $cnpj;

        $resultado = $this->con->query($sqlFornecedor);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    
        $this->con->close();
           
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($id) {

        $sqlCliente = 'SELECT * FROM contatoFor WHERE idContato = '. $id;

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
        $this->cnpjFornecedor = $dados['cnpj_fornecedor'];
        $this->telefone = $dados['telefone'];

        $sqlFornecedor = "INSERT INTO contatoFor (cnpj, contato) VALUE('$this->cnpjFornecedor','$this->telefone')";
        $resultado = $this->con->query($sqlFornecedor);
        
        if($resultado) {
            header('Location: contatos_fornecedor.php?cnpj='.$this->cnpjFornecedor);
        } else {
            return  $msg = [
                        "status"   => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                        "cnpj"      => $this->cnpjFornecedor,
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
        
        $id = $dados['id_contato'];
        $this->telefone = $dados['telefone'];

        $sqlContato = "UPDATE contatoFor SET contato = '$this->telefone' WHERE idContato = '$id'";
        $resultado = $this->con->query($sqlContato);

        $sqlBusca = "SELECT cnpj FROM contatoFor WHERE idContato = '$id'";
        $busca = $this->con->query($sqlBusca);

        $cnpj = $busca->fetch_assoc();
        
        if($resultado) {            
            header('Location: contatos_fornecedor.php?cnpj='.$cnpj['cnpj']);
        } else {                    
            return  $msg = [
                        "status"   => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                        "cnpj"      => $this->cnpjFornecedor,
                    ];
        }

        $this->con->close();
    }

    /**
     * Deletar
     * @param $id
     * Deleta o registro
     */
    public function deletar($id) {
        $sqlContato = "DELETE FROM contatoFor WHERE idContato = '$id'";
        $resultado = $this->con->query($sqlContato);
        
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