<?php

class Contato{
    public $id;
    public $telefone;
    public $email;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os contatos cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela contato 
        $query = "select * from contato";

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
    Função para cadastrar os contatos no banco de dados
    */
    public function cadastro(){
        $query = "insert into contato set telefone=:t, email=:e";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));


        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarContato(){
        $query = "update contato set telefone=:t, email=:e where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":i",$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from contato where id=?";

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