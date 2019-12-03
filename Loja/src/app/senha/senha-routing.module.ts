import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SenhaPage } from './senha.page';

const routes: Routes = [
  {
    path: '',
    component: SenhaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SenhaPageRoutingModule {}
