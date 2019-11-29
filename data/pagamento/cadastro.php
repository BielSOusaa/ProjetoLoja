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

include_once"../../domain/pagamento.php";

$database = new Database();
$db = $database->getConnection();

$pagamento = new Pagamento($db);

/*
O cliente irá enviar os dados no formato json. Porém nós precisamos dos dados
no formato php para cadastrar em banco de dados. Para realizar essa conversão
iremos usar o banco json_decode. Assim o cliente enviar os dados. estes são
lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
php.
*/
$data = json_decode(file_get_contents("php://input"));

#verificar se os campos estão com dados.
if(!empty($data->id_pedido) && !empty($data->valor) && !empty($data->formapagamento) && !empty($data->descricao) && !empty($data->numeroparcelas) && !empty($data->valorparcela)){

    $pagamento->id_pedido = $data->id_pedido;
    $pagamento->valor = $data->valor;
    $pagamento->formapagamento = $data->formapagamento;
    $pagamento->descricao = $data->descricao;
    $pagamento->numeroparcelas = $data->numeroparcelas;
    $pagamento->valorparcela = $data->valorparcela;

    if($pagamento->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"pagamento cadastrado com sucesso!"));
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