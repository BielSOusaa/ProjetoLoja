<?php

    /*
    Vamos construir os cabeçalhos para o trabalho com a api
    */
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset-utf-8");

#Esse cabeçalho define o metodo de envio com POST, ou sejá, como cadastro
header("Access-Control-Allow-Methods:POST");

#Define o tempo de espera da api. Neste caso é 1 minuto.
header("Access-Control-Max-Age:3600");

include_once"../../config/database.php";

include_once"../../domain/cadgeral.php";

$database = new Database();
$db = $database->getConnection();

$cadgeral = new CadGeral($db);

/*
O cadgeral irá enviar os dados no formato json. Porém nós precisamos dos dados
no formato php para cadastrar em banco de dados. Para realizar essa conversão
iremos usar o banco json_decode. Assim o cadgeral enviar os dados. estes são
lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
php.
*/
$data = json_decode(file_get_contents("php://input"));

#verificar se os campos estão com dados.
if(!empty($data->nome) && !empty($data->cpf) && !empty($data->usuario) && !empty($data->senha) && !empty($data->email)){

        $cadgeral-> usuario = $data-> usuario;   
        $cadgeral-> senha = $data-> senha;
        $cadgeral-> foto = $data-> foto;
        $cadgeral-> nome = $data-> nome;
        $cadgeral-> cpf = $data-> cpf;
        $cadgeral-> telefone = $data-> telefone;
        $cadgeral-> email = $data-> email;
        $cadgeral-> logradouro = $data-> logradouro;
        $cadgeral-> numero = $data-> numero;
        $cadgeral-> complemento = $data-> complemento;
        $cadgeral-> bairro = $data-> bairro;
        $cadgeral-> cep = $data-> cep;

    if($cadgeral->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"cadgeral cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel cadastrar."));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para cadastrar"));
}
?>