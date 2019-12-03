import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FotoPage } from './foto.page';

const routes: Routes = [
  {
    path: '',
    component: FotoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FotoPageRoutingModule {}
