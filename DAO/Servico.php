<?php
/**
 * Classe Serviço
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class Servico {

    // Atributos
    private $con;
    // Atributos do model
    private $descricaoServico;    
    private $valorServico;    

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
        $sqlServico = "SELECT * FROM servico";

        $resultado = $this->con->query($sqlServico);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($idServico) {
        $sqlPeca = "SELECT * FROM servico WHERE idServico = '$idServico'";
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
        $this->descricaoServico  = $dados['descricao_servico'];
        $this->valorServico = $dados['valor_servico']; 

        $sqlServico = "INSERT INTO servico (descricaoServico, valorServico) VALUES ('$this->descricaoServico', '$this->valorServico')";
        $resultado = $this->con->query($sqlServico);        
        
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
        $this->descricaoServico  = $dados['descricao_servico'];
        $this->valorServico = $dados['valor_servico'];         
        $idServico = $dados['id_servico'];

        $sqlServico = "UPDATE servico  SET descricaoServico = '$this->descricaoServico', valorServico = '$this->valorServico' WHERE idServico = '$idServico'";
        $resultado = $this->con->query($sqlServico);
        
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
    public function deletar($idServico) {
        $sqlServico = "DELETE FROM servico WHERE idServico = '$idServico'";
        $resultado = $this->con->query($sqlServico);
        
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
        //
    }
}