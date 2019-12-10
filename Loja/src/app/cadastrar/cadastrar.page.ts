import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-cadastrar',
  templateUrl: './cadastrar.page.html',
  styleUrls: ['./cadastrar.page.scss'],
})
export class CadastrarPage implements OnInit {

  constructor() { }

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
