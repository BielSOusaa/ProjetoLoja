import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.page.html',
  styleUrls: ['./perfil.page.scss'],
})
export class PerfilPage implements OnInit {

  public perfil:Array<Object>=[];

  constructor() { }

  ngOnInit() {
    var dados:any = window.localStorage.getItem("dadosCliente");
    const resultado = JSON.parse(dados);
    this.perfil = resultado.saida;
  }

}
