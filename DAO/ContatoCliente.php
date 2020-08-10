<?php
/**
 * Classe ContatoCliente
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class ContatoCliente {

    // Atributos
    private $con;
    private $cpfCliente;
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
    public function index($cpf) {
        $sqlCliente = 'SELECT * FROM contatoCli WHERE cpf = '. $cpf;

        $resultado = $this->con->query($sqlCliente);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    
        $this->con->close();
           
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($id) {

        $sqlCliente = 'SELECT * FROM contatoCli WHERE idContato = '. $id;

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
        $this->cpf = $dados['cpf_cliente'];
        $this->telefone = $dados['telefone'];

        $sqlCliente = "INSERT INTO contatoCli (cpf, contato) VALUE('$this->cpf','$this->telefone')";
        $resultado = $this->con->query($sqlCliente);
        
        if($resultado) {
            header('Location: contatos_cliente.php?cpf='.$this->cpf);
        } else {
            return  $msg = [
                        "status"   => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                        "cpf"      => $this->cpf,
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

        $sqlContato = "UPDATE contatoCli SET contato = '$this->telefone' WHERE idContato = '$id'";
        $resultado = $this->con->query($sqlContato);

        $sqlBusca = "SELECT cpf FROM contatoCli WHERE idContato = '$id'";
        $busca = $this->con->query($sqlBusca);

        $cpf = $busca->fetch_assoc();
        
        if($resultado) {            
            header('Location: contatos_cliente.php?cpf='.$cpf['cpf']);
        } else {                    
            return  $msg = [
                        "status"   => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                        "cpf"      => $this->cpf,
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
        $sqlContato = "DELETE FROM contatoCli WHERE idContato = '$id'";
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