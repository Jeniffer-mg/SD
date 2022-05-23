import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { DirectorViewComponent } from './pages/director-view/director-view.component';
import { TeacherViewComponent } from './pages/teacher-view/teacher-view.component';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatTableModule } from '@angular/material/table';
import { GraficoBarrasComponent } from './components/grafico-barras/grafico-barras.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    DirectorViewComponent,
    TeacherViewComponent,
    GraficoBarrasComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    BrowserAnimationsModule,
    MatTableModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
