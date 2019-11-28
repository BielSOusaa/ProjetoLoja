<?php

class Endereco{
    public $id;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os enderecos cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela endereco 
        $query = "select * from endereco";

        /*
        Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */

        $stmt = $this -> conexao -> prepare ($query);

        #execução da consulta a guarda de dados na variavel stml

        $stmt->execute();

        #retorna os dados do usuario a camada data.
        return $stmt;
    }
    
    /*
    Função para cadastrar os enderecos no banco de dados
    */
    public function cadastro(){
        $query = "insert into endereco set logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:e";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->logradouro = htmlspecialchars(strip_tags($this->logradouro));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->complemento = htmlspecialchars(strip_tags($this->complemento));
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));
        $this->cep = htmlspecialchars(strip_tags($this->cep));


        $stmt->bindParam(":l",$this->logradouro);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":c",$this->complemento);
        $stmt->bindParam(":b",$this->bairro);
        $stmt->bindParam(":e",$this->cep);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarEndereco(){
        $query = "update endereco set logradouro=:l, numero=:e, complemento=:c, bairro=:b, cep=:e where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":l",$this->logradouro);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":c",$this->complemento);
        $stmt->bindParam(":b",$this->bairro);
        $stmt->bindParam(":e",$this->cep);
        $stmt->bindParam(":i",$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from endereco where id=?";

        $stmt=$this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    }

?>