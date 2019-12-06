import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { NavController } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  private url:string="http://localhost/dbloja/data/produto/listar.php";

  /*
  Vamos receber os produtos cadastrados na forma de json da
  API por meio da url acima.
  O conteúdo que virá será uma lista de objetos, ou seja, uma
  Lista de produtos.
  Para utilizar essa lista na página principal(home.html) estamos
  Usando um Array de objetos que receberá os dados da API
  e irá repassar para o nosso laço(*ngFor) na home.
  */
  public produtos:Array<Object>=[];
  constructor(private http:HttpClient, private router:Router) {}

  public navDetalheProduto(id:string){
    console.log(id);
    this.router.navigate(['detalheproduto',{idprod:id}])
  }

  /*
  O comando ngOnInit(ng->Todos os comandos internos do Angular |
    On->Ativar, Ligar | Init->Initialize = Iniciar).
    No momento em que a página home inicializa será feita uma requisição
    http dentro do método ngOnInit para buscar os
    produtos cadastrados.
    O comando ngOnInit é iniciado automáticamento, portanto
    não é necessário chamar. 
  */

  ngOnInit(){

    /*
    Os comandos:
      this -> refere-se a essa classe HomePage e todo o seu
      conteúdo;
      http -> é um elemento tipado como HttpClient responsável
      Por fazer as requisições com REST com os verbos: get,
      post, put e delete. Esse elemento foi declarado no
      construtor da classe. Construtor é responsável por iniciar
      A classe com o seu conteúdo;
      get -> Significa obter é responsável por chamar o conteúdo
      da página listar com todos os seus produtos.
      _____________________________________________________________
      O comando get requisata a url para fazer a chamada dos
      produtos, por isso é passado entre párenteses a
      url criada no contexto da classe e chamada com o comando
      this.url.
      O comando subscribe(Observable) é responsável por recepcionar
      os dados vindos da url listar produtos com todos os seus
      produtos. Estes são repassados para o objeto data e seu
      conteúdo é tratado de forma genérica com o comando
      (data as any) e atribuido a constante prod, fazemos a exbição
      deste na tela de console.

      Mais abaixo, o comando error trata os eventuais erros ocorridos
      durante a requisição da API.
    */
    this.http.get(this.url).subscribe(
      data => {
        const prod = (data as any);
        this.produtos = prod.saida;
      }, error=>{
        console.log("Erro ao requisitar a API "+error);
      }
    )
  }


}
