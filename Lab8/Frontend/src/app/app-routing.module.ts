import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {VacationsPageComponent} from './vacations-page/vacations-page.component';
import {EditVacationPageComponent} from './edit-vacation-page/edit-vacation-page.component';
import {MyVacationsPageComponent} from './my-vacations-page/my-vacations-page.component';
import {NewVacationPageComponent} from './new-vacation-page/new-vacation-page.component';

const routes: Routes = [
  {path: '', redirectTo: '/vacations', pathMatch: 'full'},
  {path: 'vacations', component: VacationsPageComponent, pathMatch: 'full'},
  {path: 'edit-vacation/:id', component: EditVacationPageComponent},
  {path: 'my-vacations', component: MyVacationsPageComponent},
  {path: 'new-vacation', component: NewVacationPageComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
