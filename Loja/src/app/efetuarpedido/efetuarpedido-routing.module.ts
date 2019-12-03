import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EfetuarpedidoPage } from './efetuarpedido.page';

const routes: Routes = [
  {
    path: '',
    component: EfetuarpedidoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class EfetuarpedidoPageRoutingModule {}
