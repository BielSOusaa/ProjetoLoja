import { Component, OnInit } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-cadastrar',
  templateUrl: './cadastrar.page.html',
  styleUrls: ['./cadastrar.page.scss'],
})
export class CadastrarPage implements OnInit {

  public model:DadosCadastrar = null;

  constructor() {

    this.model = new DadosCadastrar();

    this.model.nome="";
    this.model.cpf="";
    this.model.usuario="";
    this.model.senha="";
    this.model.foto="";
    this.model.logradouro="";
    this.model.numero="";
    this.model.complemento="";
    this.model.bairro="";
    this.model.cep="";
    this.model.telefone="";
    this.model.email="";
  }

  public efetuarcadastro(){
    
    var headers = new HttpHeaders();
    headers.append("Access-Control-Allow-Origin","*");
    headers.append("Access-Control-Method","POST");
    headers.append("Accept","application/json");
    headers.append("Content-Type","application/json");

    var dados={
      "usuario":this.model.usuario,
      "senha":this.model.senha,
      "foto":this.model.foto,
      "telefone":this.model.telefone,
      "email":this.model.email,
      "logradouro":this.model.logradouro,
      "numero":this.model.numero,
      "complemento":this.model.complemento,
      "bairro":this.model.bairro,
      "cep":this.model.cep,
      "nome":this.model.nome,
      "cpf":this.model.cpf
    }

  }

  ngOnInit() {
  }

}

export class DadosCadastrar{
  nome:string;
  cpf:string;
  usuario:string;
  senha:string;
  foto:string;
  logradouro:string;
  numero:string;
  complemento:string;
  bairro:string;
  cep:string;
  telefone:string;
  email:string;
  
  
  

}
