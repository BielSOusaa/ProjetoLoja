import { Component, OnInit } from '@angular/core';
import { NavController, NavParams } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-detalheproduto',
  templateUrl: './detalheproduto.page.html',
  styleUrls: ['./detalheproduto.page.scss'],
})
export class DetalheprodutoPage implements OnInit {


  private idProduto:any;

  constructor(private active: ActivatedRoute) {

    
   }

  ngOnInit() {
    this.active.params.subscribe((params)=>{
      this.idProduto = params.idprod;
      console.log("Esse id está em Detalhes ",params);
    });
    console.log("Definitivo "+this.idProduto);
    
  }

}
