<?php

/**
 * Classe Conectar
 * Responsável por fazer a conexão com o Banco de Dados
 */

class Conectar {
    
    // Atributos
    private $host;
    private $bancoDeDados;
    private $usuario;
    private $senha;
    private $mysqli;

    /**
     * Construtor Padrão
     */
    public function __construct() {
        // Aqui troca os dados pelo que você usa ai no banco de dados
        $this->host         = 'localhost';
        $this->bancoDeDados = 'mydb';
        $this->usuario      = 'root';
        $this->senha        = '';
    }

    /**
     * Conexao
     * Faz a Conexão com o banco de dados
     */
    public function conexao() {
        $this->mysqli = new mysqli($this->host, $this->usuario, $this->senha, $this->bancoDeDados);
        if ($this->mysqli->connect_errno) {
            echo "Falha ao conectar";
        }
    }

}