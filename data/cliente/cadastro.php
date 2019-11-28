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

include_once"../../domain/cliente.php";

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

/*
O cliente irá enviar os dados no formato json. Porém nós precisamos dos dados
no formato php para cadastrar em banco de dados. Para realizar essa conversão
iremos usar o banco json_decode. Assim o cliente enviar os dados. estes são
lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
php.
*/
$data = json_decode(file_get_contents("php://input"));

#verificar se os campos estão com dados.
if(!empty($data->nome) && !empty($data->cpf) && !empty($data->id_endereco) && !empty($data->id_contato) && !empty($data->id_usuario)){

    $cliente->nome = $data->nome;
    $cliente->cpf = $data->cpf;
    $cliente->id_endereco = $data->id_endereco;
    $cliente->id_contato = $data->id_contato;
    $cliente->id_usuario = $data->id_usuario;

    if($cliente->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"cliente cadastrado com sucesso!"));
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