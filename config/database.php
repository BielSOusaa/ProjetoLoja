<?php
/*
A classe database ira permitir a comunicação com o banco de dados
nessa classe teremos a string de conexao com o banco, bem como:
 - Nome de usuário: "root"
 - Senha: "" -> Vazio neste caso
 - Banco de Dados: dbloja
 - Porta de comunicação: 3306
 - Servidor: localhost ou IP(local ou remoto)
E uma variavel para a aconexao com o banco que será usada em outros
arquivos e, portanto, será declarado com a modificação public
*/
    class database{

        public $conexao;
        public function getConnection(){
            try{
                $conexao = new PDO("msql:host=localhost;port=3306;dbname=dbloja","root","");
                #definir o tipo de caracter para o banco como utf8 que é caracter acentuado
                $conexao->exec("set name utf8");
            }
            catch(PDOException $e){
                echo "Erro ao tentar estabelecer a conexao com o banco de dados.".$e->getMessage();
            }
            return $conexao;
        }

    }

?>