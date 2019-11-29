<?php
#Vamos construir os cabeçalhos para o trabalho com a api
header("Access-Control-Allow-Origin:*");
header("COntent-Type: application/json; charset=utf-8");

#se não for adicionado o metodo a ser utilizado ele utilizara o PUT por padrão
header("Access-Control-Allow-Method:PUT");
#Define o tempo de espera da api. Neste caso é de 1 minuto.
header("Access-Control-Max-Age:3600");

include_once "../../config/database.php";
include_once "../../domain/pagamento.php";

$database = new Database();
$db = $database->getConnection();

$pagamento = new Pagamento($db);

#O cliente ira enviar os dados no formato json. Porem nos precisamos dos dados no formato php para cadastrar em banco de dados.
#Para realizar essa conversão ie=remos usar o banco json_decode. Assim o cliente vai enviar os daos, estes são lidos pela entrada php: 
#e seu conteudo é capturado e convertido para o formato php.
$data = json_decode(file_get_contents("php://input"));

#verificar se os campos estão com dados.
if(!empty($data->id_pedido) && !empty($data->valor) && !empty($data->id)  && !empty($data->formapagamento)  && !empty($data->descriacao)
&& !empty($data->numeroparcelas)  && !empty($data->valordaparcela){
    $pagamento->id_pedido = $data->id_pedido;
    $pagamento->valor = $data->valor;
    $pagamento->id = $data->id;
    $pagamento->formapagamento = $data->formapagamento;
    $pagamento->descriacao = $data->descriacao;
    $pagamento->numeroparcelas = $data->numeroparcelas;
    $pagamento->valordaparcela = $data->valordaparcela;
    


    if($pagamento->alterarpagamento()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"pagamento atualizado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel atualizar!"));
    }
    
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para atualizar"));
}
?>
