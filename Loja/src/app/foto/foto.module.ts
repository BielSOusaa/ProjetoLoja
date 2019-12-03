import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { FotoPageRoutingModule } from './foto-routing.module';

import { FotoPage } from './foto.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    FotoPageRoutingModule
  ],
  declarations: [FotoPage]
})
export class FotoPageModule {}
