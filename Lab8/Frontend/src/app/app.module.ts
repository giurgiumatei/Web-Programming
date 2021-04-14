import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule} from '@angular/common/http';
import {FormsModule} from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { VacationsPageComponent } from './vacations-page/vacations-page.component';
import { MyVacationsPageComponent } from './my-vacations-page/my-vacations-page.component';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { NewVacationPageComponent } from './new-vacation-page/new-vacation-page.component';
import { VacationDataFormComponent } from './vacation-data-form/vacation-data-form.component';
import { EditVacationPageComponent } from './edit-vacation-page/edit-vacation-page.component';
import {NgxPaginationModule} from 'ngx-pagination';
import {Ng2SearchPipeModule} from 'ng2-search-filter';


@NgModule({
  declarations: [
    AppComponent,
    VacationsPageComponent,
    MyVacationsPageComponent,
    NavBarComponent,
    NewVacationPageComponent,
    VacationDataFormComponent,
    EditVacationPageComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    NgxPaginationModule,
    Ng2SearchPipeModule,

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
