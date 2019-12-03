import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DetalheprodutoPageRoutingModule } from './detalheproduto-routing.module';

import { DetalheprodutoPage } from './detalheproduto.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DetalheprodutoPageRoutingModule
  ],
  declarations: [DetalheprodutoPage]
})
export class DetalheprodutoPageModule {}
