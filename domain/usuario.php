<?php

class Usuario{
    public $id:
    public $nomeusuario;
    public $senha;
    public $foto;

    public function __contructor($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os usuarios cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela usuario 
        $query = "select * from usuario";

        /*
        Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */

        $stmt = $this->conexao->prepare($query);

        #execução da consulta a guarda de dados na variavel stml

        $stmt->execute();

        #retorna os dados do usuario a camada data.
        return $stmt;
    }
    /*
    Função para o sistema de login de usuario
    */
    public function login(){
        /*Consulta para realizar o login. Estamos usando o nome de usuario
        ea senha. O valor para ambos os campos foi passado como
        paramêtro
        */
        $query = "select * from usuario where nomeusuario=? and senha=?";

        /*
        Abaixo há uma ligação com os paramêtros da consulta(bind-lagação |
        Param -> paramêtros) as posiçôes estão relacionadas aos pontos de
        interrogação. O primeiro ponto de interrogação é destinado ao
        nome de usuário e segundo a senha.
        */
        $stmt-> $this->conexao->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(1,$this->nomeusuario);
        $stmt->bindParam(2,$this->senha);

        $stmt->execute();

        return $stmt;
    }
    /*
    Função para cadastrar os usuarios no banco de dados
    */
    public function cadastro(){
        $query = "insert into usuario set nomeusuario=:n, senha=:2, foto=:f";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->nomeusuario = htmlspecialchars(strip_tags($this->nomeusuario));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->foto = htmlspecialchars(strip_tags($this->foto));

        #encriptografar a senha
        $this->senha = md5($this->senha);

        $stmt->bindParam(":n",$this->nomeusuario);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":f",$this->foto);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }
    public function alterar(){

    }
    public function alterarFoto(){
        $query = "update usuario set foto=:f where id=i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":i",$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function alterarSenha(){
        $query = "update usuario set senha=? where id=?";

        $stmt=$this->conexao->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(1,$this->senha);
        $stmt->bindParam(2,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from usuario where id=?";

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

}

?>