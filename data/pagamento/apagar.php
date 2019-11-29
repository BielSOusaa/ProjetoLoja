<?php
#Vamos construir os cabeçalhos para o trabalho com a api
header("Access-Control-Allow-Origin:*");
header("COntent-Type: application/json; charset=utf-8");

#Esse cabeçalho define o metodo de envio como DELETE, para deletar o banco.
header("Access-Control-Allow-Method:DELETE");
#Define o tempo de espera da api. Neste caso é de 1 minuto.
header("Access-Control-Max-Age:3600");

include_once "../../config/database.php";
include_once "../../domain/pagamento.php";

$database = new Database();
$db = $database->getConnection();

$pagamento = new Pagamento($db);

#O cliente ira enviar os dados no formato json. Porem nos precisamos dos dados no formato php para deletar o banco de dados.
#Para realizar essa conversão iremos usar o comando json_decode. Assim o cliente vai enviar os daos, estes são lidos pela entrada php: 
#e seu conteudo é capturado e convertido para o formato php.
$data = json_decode(file_get_contents("php://input"));

#verificar se os campos estão com dados.
if(!empty($data->id)){
    $pagamento->id = $data->id;

    if($pagamento->apagar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"pagamento deletado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel deletar o pagamento"));
    }
   
    
}

?>