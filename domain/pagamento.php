<?php

    class Pagamento{
        public $id;
        public $id_pedido;
        public $valor;
        public $formapagamento;
        public $descriacao;
        public $numeroparcela;
        public $valordaparcela;
        



        public function __construct($db){
            $this->conexao = $db;
        }

        #Função para listar todos os pagamentos cadastrados no banco de dados.
        # Essa função retorna uma lista com todos os dados.

        public function listar(){
            #Seleciona todos os dados da tabela pagamento
            $query = "select * from pagamento";

            #Foi criada a variavel stmt (Statement) para guardar a preparação da consulta
            #select que sera executada posteriormente.

            $stmt = $this->conexao->prepare($query);

            #Execução da consulta e garda de dados na variavel stmt

            $stmt->execute();

            #Retorna os dados do pagamento acamada darta.

            return $stmt;
        }        
                #Função para cadastrar os pagamentos no banco de dados
        public function Pagamento(){
            $query = "update into pagamento set id_pedido=:n, valor=:d, formapagamento=:p,
            descriacao=:i, numeroparcela=:ii, valordaparcela=:u=";
            $stmt = $this->conexao->prepare($query);
            #Foram utilizadas 2 funções para tratar os dados que estão vindo do pagamento para a api.
            #string_tags-> trata os dados em seus formatos inteiro, double ou decimal
            #htmlspecialchar -> retira as aspas e os 2 pontos que vem do formato json para cadastrar no banco.
            $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
            $this->valor = htmlspecialchars(strip_tags($this->valor));
            $this->formapagamento = htmlspecialchars(strip_tags($this->formapagamento));
            $this->descriacao = htmlspecialchars(strip_tags($this->descriacao));
            $this->numeroparcela = htmlspecialchars(strip_tags($this->numeroparcela));
            $this->valordaparcela = htmlspecialchars(strip_tags($this->valordaparcela));
           


            #Encriptografar a senha


            $stmt->bindParam(":n",$this->id_pedido);
            $stmt->bindParam(":d",$this->valor);
            $stmt->bindParam(":p",$this->formapagamento);
            $stmt->bindParam(":i",$this->descriacao);
            $stmt->bindParam(":ii",$this->numeroparcela);
            $stmt->bindParam(":u",$this->valordaparcela);
            


            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function alterarpagamento(){
            $query = "update into pagamento set id_pedido=:n, valor=:d, formapagamento=:p,
            descriacao=:i, numeroparcela=:ii, valordaparcela=:u, imagem4=:iv";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(":n",$this->id_pedido);
            $stmt->bindParam(":d",$this->valor);
            $stmt->bindParam(":p",$this->formapagamento);
            $stmt->bindParam(":i",$this->descriacao);
            $stmt->bindParam(":ii",$this->numeroparcela);
            $stmt->bindParam(":u",$this->valordaparcela);
            $stmt->bindParam(":iv",$this->imagem4);

            if($stmt->execute()){
                return true;

                }
            else{
                return false;
                }
           }
           public function apagar(){
            $query = "delete from pagamento where id=?";

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