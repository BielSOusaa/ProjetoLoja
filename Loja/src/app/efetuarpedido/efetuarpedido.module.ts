import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { EfetuarpedidoPageRoutingModule } from './efetuarpedido-routing.module';

import { EfetuarpedidoPage } from './efetuarpedido.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    EfetuarpedidoPageRoutingModule
  ],
  declarations: [EfetuarpedidoPage]
})
export class EfetuarpedidoPageModule {}
