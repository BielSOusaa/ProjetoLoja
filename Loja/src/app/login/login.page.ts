import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpHeaders, HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  private url:string = "http://localhost/dbloja/data/usuario/login.php";
  public modelUs:Usuario;

  constructor(private router:Router, private http:HttpClient) {


    this.modelUs = new Usuario();
    this.modelUs.usuario="";
    this.modelUs.senha="";
   }

  public cadastrar(){
    this.router.navigate(['/cadastrar']);
  }

  public efetuarlogin(){
    var headers = new HttpHeaders();
    headers.append("Accept","application/json");
    headers.append("Content-Type","application/json");
    headers.append("Access-Control-Allow-Origin","*");

    var dados= {
      "usuario":this.modelUs.usuario,
      "senha":this.modelUs.senha
    };

    this.http.get(this.url,{headers:headers,params:dados}).subscribe(
      data=>{

        var rs = (data as any);
        console.log(rs);
          var n:string = rs.saida[0].nome;

          if(n!=""){
            console.log(rs);
            /*
            Vamos pegar as informações que estão retornando da API deste usuário
            logado e adicionar ao bando de dados do IONIC.
            Utilizaremos o comando window.localStorage.setItem("Key","value");
            O comando localStorage usa o banco de dados de ionic e consequentemente o banco
            do telefone. Neste comando temos os seguinte métodos:
            setItem -> quando se deseja gravar os dados no banco;
            getItem -> quando se deseja resgatar os dados cadastrados no banco;
            removeItem -> quando se deseja apagar os dados do banco de dados;
            */

            window.localStorage.setItem("dadosCliente",JSON.stringify(rs));
            this.router.navigate(['/home']);
        }
        else
        {
          alert("Usuário ou senha incorretos");
        }
      },
      error=>{
        alert("Usuário ou senha incorretos");
        console.log("Erro ao tentar logar"+error);
      }
    );

  }

  ngOnInit() {
  }

}
export class Usuario{
  usuario:string;
  senha:string;
}
