import { Component, OnInit } from '@angular/core';
import { NavController, NavParams } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';
import { HttpClient, HttpRequest, HttpHeaders,  } from '@angular/common/http';

@Component({
  selector: 'app-detalheproduto',
  templateUrl: './detalheproduto.page.html',
  styleUrls: ['./detalheproduto.page.scss'],
})
export class DetalheprodutoPage implements OnInit {

  private url:string="http://localhost/dbloja/data/produto/pesquisar_id.php";
  private idProduto:any;
  public produtos:Array<Object>=[];

  constructor(private active: ActivatedRoute, private http:HttpClient) {

    
   }

  ngOnInit() {
    this.active.params.subscribe((params)=>{
      this.idProduto = params.idprod;
      console.log("Esse id está em Detalhes ",params);
    });
    console.log("Definitivo "+this.idProduto);

    let dados:any = {id:this.idProduto};

    var headers = new HttpHeaders();
    headers.append("Accept","application/json");
    headers.append("Content-Type","application/json");
    // const headerOpcoes = new HttpRequest.arguments({headers:headers})


    this.http.get(this.url,{headers:headers,params: dados}).subscribe(
      data => {
        const prod = (data as any);
        this.produtos = prod.saida;
        console.log(this.produtos);
      }, error=>{
        console.log("Erro ao requisitar a API "+error);
      }
    )
    
  }


  public exibirDados(){

    var dados:any = window.localStorage.getItem("dadosCliente");
    console.log("Estamos na pagina detalhes -> "+dados);

  }

}
