<?php

/*
Este cabeçalho permite o acesso a listagem de pagamento
com diversas origens. Por isso estamos usando o *(asteristico)
para essa permissão que será para http,https,file,ftp
*/
header("Access-Control-Allow-Origin:*");

/*
Vamos definir qual será o formato de dados que o pagamento
irá enviar o api. Este formato será do tipo JSON(javascript ON
Notation)
*/

header("Content-Type: application/json;charset=utf-8");

/*
Abaixo estamos incluindo o arquivo database.php que possui a
classe Database com a conexão com o banco de dados.
*/

include_once "../../config/database.php";
/*
O arquivo pagamento.php foi incluido para que a classe pagamento fosse
Utilizado. Vale lembrar que esta classe possui o CRUD para o pagamento.
*/
include_once "../../domain/pagamento.php";

/*
Criamos um objeto chamado $database. é uma instância do Database.
Quando usamos o termo new, estamos criando uma instância, ou seja,
um objeto da classe Database. Isso nos dará acesso a todos os dados
da classe Database.
*/
$database = new Database();
/*
Executamos a função getConnection que estabalece a conexão com o banco
de dados. E retorna essa conexão realizada para a variavel $db
*/
$db = $database->getConnection();

/*
Instância da classe pagamento e, portanto, criação do objeto chamado $pagamento.
Isso fará com que todos as funçôes que estão da classe pagamento sejam
tranferidas para o objeto $pagamento.
Durante a instância foi passada como por paramêtro a variável. $db que possui
a comunicação com o banco de dados e também a variável conexão. Utilizando
para a usada dos comandos de CRUD
*/

$pagamento = new Pagamento($db);

/*
A variável $stmt(Statement -> sentenção) foi criada para guardar o retorno
da consulta que está na função listar. Dentro da função listar() Temos uma
consulta no formato sql que seleciona todos os pagamento("Select * from pagamento")
*/

$stmt = $pagamento->listar();

/*
Se a consulta retorna uma quantidade de linhas maior que 0(zero). então será
construido um array com os dados dos pagamentos.
Caso contrário será exibida uma mensagem que não pagamentos cadastrados
*/

if($stmt->rowCount() > 0){

    /*
    Para organizar os pagamentos cadastrados em banco e exibi-los em tela, foi
    criado com array com o nome de saida e assim guardar todos pagamentos.
    */
 
    $pagamento_arr = array();
    $pagamento_arr["saida"]=array();

    /*
    A estrutura while(enquando) realizar a busca e todos os pagamentos
    cadastrados até chegar ao final da tabela e tras os dados
    para fetch array organizar em formato de array.
    Assim será mais fácil de adicionar no array de pagamentos para ser
    apresentado ao pagamento.
    */
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){

        /*
        O comando extract é capaz de separar de forma mais simples
        os campos da tabela pagamentos.
        */
        extract($linha);

        /*
        Pegar um campo por vez do comando extract e adicionar em um
        array de itens, pois será assim que os pagamentos serão tratados,
        um pagamento por vez com seus respectivos dados.
        */
        $array_item = array(
            "id"=>$id,
            "id_pedido"=>$id_pedido,
            "valor"=>$valor,
            "formapagamento"=>utf8_encode($formapagamento),
            "descricao"=>utf8_encode($descricao),
            "numeroparcelas"=>$numeroparcelas,
            "valorparcela"=>$valorparcela
        );
        /*
        Pegar um item gerado pela array_item e adicionar a saída, que
        também  é um array.
        array_push é um comando em que você pode adicionar algo em um
        array. Assim estamos adicionando ao pagamentos_arr[saída] um item
        que é um pagamento com seus respectivos dados.
        */

        array_push($pagamento_arr["saida"],$array_item);
    }

    /*
    O comando header(cabeçalho) responde via HTTP o status code 200 que
    representa sucesso na consulta de dados.
    */

    header("HTTP/1.0 200");
    /*
    Pegamos o array pagamento_arr que foi construido em php com os dados
    dos pagamentos e convertemos para o formato json para exibir ao
    cliente requisitante.
    */
    echo json_encode($pagamento_arr);

}
else{
    /*
    O comando header(cabeçalho) responde ao cliente o status 400(badrequest)
    caso não hoje pagamentos cadastrados no banco. Junto ao status code será exibido
    a mensagem "mensagem: Não há pagamentos cadastrados" que será mostrando por meio
    do comando json_encode
    */
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há pagamentos cadastrados"));
}


?>