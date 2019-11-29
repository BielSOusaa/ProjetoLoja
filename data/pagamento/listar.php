<?php

#Este cabeçalho permite o acesso a listagem de pagamento com diversas origens.
#Por isso estamos usando o * para esta permissão que funcionara para http, htpps, file, ftp.

header("Access-Control-Allow-Origin:*");

#Vamos definir qual sera o formato de dados que o pagamento ira enviar a api. Este formato sera 
#do tipo JSON.
header("Content-Type: application/json;charset=utf-8");

#Abaixo estamos incluindo o arquivo database.php que possui a classe Database com conexão com o
#banco de dados

include_once "../../config/database.php";

#O arquivo pagamento.php foi incluido para que a classe pagamento fosse utilizada.
#Vale lembrar que esta classe possui o CRUD para o pagamento.

include_once "../../domain/pagamento.php";

#Criamos um objeto chamado $database. É uma instancia da classe Database. Quando usamos o termo
#new, estamos criando uma instancia, ou seja, um objeto da classe database. Isso nos dará acesso a todos os dados da clase Database.

$database = new Database();

#Executamos a função getConnection que estabelece a conexão com o banco de dados. E retorna essa conexão para a variavel $db

$db = $database->getConnection();

#Instancia da classe pagamento e, portanto, criação do objeto $pagamento. Isso fara com que todas as funções que estão dentro da classe Contatpo
#sejam transferidos para o objeto $pagamento. 
#Durante a instancia foi passado como paramêtro a variável $db que possui a comunicação com o banco de dados e também a variável conexão.
#Utilizada para o uso dos comandos do CRUD.

$pagamento = new Pagamento($db);

#A variavel $stmt foi criada para guardar o retorno da consulta que esta na função listar. Dentro da função listar() temos uma consulta no formato
#sql que seleciona todos os pagamento.

$stmt = $pagamento->listar();

#se a consulta retornar uma quantidade maior que 0, então sera construido um array com os dados dos pagamento.
#Caso contrario sera exibida uma mensagem que não ha pagamento cadastrados.

if($stmt->rowCount() > 0){

#Para organizaros pagamento cadastrados em banco e exibi-los em tela, foi criado um array com id_pedido de saida assim guardar todos os pagamento.

    $pagamento_arr["saida"]=array();

    #A estrutura while(enquanto) realiza a busca e todos os pagamento cadastrados até chegar ao final da tabela e trazer os dados para fetch
    #array organizar em formato de array. Assim sera mais facil de adcionar no array de pagamento para ser apresentado ao pagamento.

    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){

        #O comando extract é capaz de separar de forma mais simples os campos da tabela pagamento.

        extract($linha);

        #Pegar um campo por vez do comando extract e adicionar em um array de itens, pois sera assim que os pagamento serão tratados, um pagamento 
        #por vez com seus respectivos dados.

        $array_item = array(
            "id"=>$id,
            "id_pedido"=>$id_pedido,
            "valor"=>$valor,
            "formapagamento"=>$formapagamento,
            "numeroparcelas"=>$numeroparcelas,
            "valordaparcela"=>$valordaparcela,
            
        );

        #Pegar um item gerado pelo array_item e adcionar a saida, que também é um array. array_push é um comando em que voce pode adicionar algo em um
        #array. Assimestamos adicionando ao pagamento_arr[saida] um item que é um pagamento com seus respectivos dados.

        array_push($pagamento_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");

    #Pefamos o array pagamento_arr que foi construido em php com dados do pagamento e convertendo para o formato json para exibir ao cliente requisitante.

    echo json_encode($pagamento_arr);



}
else{

    #O comando header responde ao cliente o status code 400(badrequest) caso não haja pagamento cadastrados no banco. Junto ao status code sera exibida 
    #a mesnagem que sera mostrada por meio do comando json_encode

    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há pagamentos cadastrados"));
}



?>
