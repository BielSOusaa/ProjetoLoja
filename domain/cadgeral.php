<?php

class CadGeral{
        public $usuario;
        public $senha;
        public $foto;
        public $nome;
        public $cpf;
        public $id_usuario;
        public $id_contato;
        public $id_endereco;
        public $telefone;
        public $email;
        public $logradouro;
        public $numero;
        public $complemento;
        public $bairro;
        public $cep;
    

        public function __construct($db){
            $this->conexao = $db;
        }

    public function cadastro(){
        $queryUsuario = "insert into usuario set nomeusuario=:nu, senha=:sh, foto=:ft";

        $stmt = $this->conexao->prepare($queryUsuario);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":nu",$this->usuario);
        $stmt->bindParam(":sh",$this->senha);
        $stmt->bindParam(":ft",$this->foto);

        $stmt->execute();
        //Vamos capturar o id do usuário gerado neste instante
        $this->id_usuario = $this->conexao->lastInsertId();


        if($this->id_usuario > 0){
            //Podemos seguir para a proxima inserção.
            $queryContato = "insert contato set telefone=:te, email=:em";
            $stmt = $this->conexao->prepare($queryContato);

            $stmt->bindParam(":te",$this->telefone);
            $stmt->bindParam(":em",$this->email);

            $stmt->execute();

            $this->id_contato = $this->conexao->lastInsertId();

            if($this->id_contato > 0){

                $queryEnd ="insert into endereco set logradouro=:lo, numero=:nr, complemento=:co, bairro=:br, cep=:ce";

                $stmt = $this->conexao->prepare($queryEnd);

                $stmt->bindParam(":lo",$this->logradouro);
                $stmt->bindParam(":nr",$this->numero);
                $stmt->bindParam(":co",$this->complemento);
                $stmt->bindParam(":br",$this->bairro);
                $stmt->bindParam(":ce",$this->cep);

                $stmt->execute();

                $this->id_endereco = $this->conexao->lastInsertId();


                if($this->id_endereco > 0){
                   
                $queryCliente = "insert into cliente set nome=:n, cpf=:c, id_endereco=:e, id_contato=:o, id_usuario=:u";

                $stmt = $this->conexao->prepare($queryCliente);

                $stmt->bindParam(":n",$this->nome);
                $stmt->bindParam(":c",$this->cpf);
                $stmt->bindParam(":e",$this->id_endereco);
                $stmt->bindParam(":o",$this->id_contato);
                $stmt->bindParam(":u",$this->id_usuario);

                if($stmt->execute()){
                    return true;
                }
                else{
                    echo json_encode(array("mensagem"=>$stmt->errorInfo()));
                    return false;
                }

            }

        }

    }
    else{
        echo json_encode(array("mensagem"=>$stmt->errorInfo()));
    }
}

}
?>