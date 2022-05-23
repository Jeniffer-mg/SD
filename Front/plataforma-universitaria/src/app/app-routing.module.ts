import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DirectorViewComponent } from './pages/director-view/director-view.component';
import { LoginComponent } from './pages/login/login.component';
import { TeacherViewComponent } from './pages/teacher-view/teacher-view.component';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'teacher', component: TeacherViewComponent },
  { path: 'director', component: DirectorViewComponent },
  { path: '**', redirectTo: 'login' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
