<?php
/**
 * Classe Ordem de Servico
 */
include_once 'config/conectar.php'; // Inclui a classe de conexão

class OrdemServico {

    // Atributos
    private $con;
    // Atributos do model
    private $descricao;    
    private $dataEntrada;
    private $dataSaida;
    private $placa;    

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
        $sqlOrdemServico = "SELECT * FROM ordemServico";
        
        $resultado = $this->con->query($sqlOrdemServico);
        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
   
    }

    /**
     * Ver
     * @param $id
     */
    public function ver($idOS) {
        $sqlOrdemServico = "SELECT * FROM ordemServico WHERE idOS = '$idOS'";
        $resultado = $this->con->query($sqlOrdemServico);

        return $resultado->fetch_assoc();

        $this->con->close();
    }

    /**
     * Cadastrar
     * @param $dados
     * Cadastra os dados vindo do formulario
     */
    public function cadastrar($dados) {
        $this->descricao  = $dados['descricao_os'];
        $this->dataEntrada = $dados['data_entrada'];
        $this->dataSaida = $dados['data_saida'];
        $this->placa  = $dados['placa'];

        $sqlOrdemServico = "INSERT INTO ordemServico (descricao, dataEntrada, dataSaida, placa) VALUES ('$this->descricao', '$this->dataEntrada', '$this->dataSaida', '$this->placa')";
        $resultado = $this->con->query($sqlOrdemServico);        
        
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
        $this->descricao  = $dados['descricao_os'];
        $this->dataEntrada = $dados['data_entrada'];
        $this->dataSaida = $dados['data_saida'];
        $this->placa  = $dados['placa'];      
        $idOs = $dados['id_os'];

        $sqlOrdemServico = "UPDATE ordemServico  SET descricao = '$this->descricao', dataEntrada = '$this->dataEntrada', dataSaida = '$this->dataSaida', placa = '$this->placa' WHERE idOS = '$idOs'";
        $resultado = $this->con->query($sqlOrdemServico);
        
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
    public function deletar($idOs) {
        $sqlOrdemServico = "DELETE FROM ordemServico WHERE idOS = '$idOs'";
        $resultado = $this->con->query($sqlOrdemServico);
        
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
        $sqlOrdemServico = "SELECT * FROM peca WHERE idPeca = '$idPeca'";
        $resPeca = $this->con->query($sqlOrdemServico);
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

    
    /**
     * Contém Serviço
     */
    public function todosServicos($idOs)
    {
        $sqlTodosServicos = "SELECT * FROM contem as C
                             INNER JOIN ordemServico as O ON C.idOs = O.idOS
                             INNER JOIN servico as S ON C.idServico = S.idServico
                             WHERE C.idOS = '$idOs'";
        $response = $this->con->query($sqlTodosServicos);
        //var_dump($response->fetch_all(MYSQLI_ASSOC));

        return $response->fetch_all(MYSQLI_ASSOC);

        $this->con->close();

    }

    /**
     * Cadastrar Servico realizado
     */
    public function cadastrarSr($dados)
    {
        $idOs = $dados['id_os'];
        $idServico = $dados['id_servico'];

        $sqlSR = "INSERT INTO contem (idOs, idServico) VALUES ('$idOs', '$idServico')";
        $resultado = $this->con->query($sqlSR);

        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro inserido com sucesso!",
                        'idOs'     => $idOs,
                    ];
        } else {
            return  $msg = [
                        "status" => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                    ];
        }
    }

    /**
     * Retorna dados do Serviço
     */
    public function servicos($idServico)
    {
        $sqlServico = "SELECT * FROM servico WHERE idServico = '$idServico'";
        $response = $this->con->query($sqlServico);
        return $response->fetch_assoc();

        $this->con->close();
    }   
     
    /**
     * Cadastrar Peça Usada
     */
    public function cadastrarPeca($dados)
    {
        $idServico  = $dados['id_servico'];
        $idPeca     = $dados['id_peca'];
        $quantidade = $dados['quantidade'];

        $sqlValorPeca = "SELECT preco FROM peca WHERE idPeca = '$idPeca'";
        $retorno = $this->con->query($sqlValorPeca);
        $val = $retorno->fetch_assoc();
        $valor = $val['preco'] * $quantidade;

        $sqlPeca = "INSERT INTO usapeca (idServico, idPeca, quantidadeVendida, valorPecas) VALUES ('$idServico', '$idPeca', '$quantidade', '$valor')";
        $resultado = $this->con->query($sqlPeca);

        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro inserido com sucesso!",                        
                        'idServico' => $idServico,
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
     * Peças Usadas
     */
    public function pecasUsadas($idServico)
    {
        $sqlPecas = "SELECT * FROM usapeca as U
                     JOIN peca as P ON U.idPeca = P.idPeca
                     WHERE U.idServico = '$idServico'";
        $resultado = $this->con->query($sqlPecas);

        return $resultado->fetch_all(MYSQLI_ASSOC);

        $this->con->close();
    }

    /**
     * Deleta Item
     */
    public function deletarItem($dados)
    {
        $idPeca = $dados['idPeca'];
        $idServico = $dados['idServico'];
        $sqlItem = "DELETE FROM usapeca WHERE idPeca = '$idPeca'";
        $resultado = $this->con->query($sqlItem);

        if($resultado) {
            return  $msg = [
                        "status"   => "ok",
                        "mensagem" => "Registro inserido com sucesso!",                        
                        'idServico' => $idServico,
                    ];
        } else {
            return  $msg = [
                        "status" => "erro",
                        "mensagem" => "Erro ao inserir Registro!" . $resultado . " - " . mysqli_error($this->con),
                    ];
        }

        $this->con->close();
    }
}