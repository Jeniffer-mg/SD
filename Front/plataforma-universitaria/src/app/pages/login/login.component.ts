import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  email: string = '';
  password: string = '';

  constructor(
    private requestService: RequestService,
    private readonly router: Router
    ) {
    // This is empty
  }

  ngOnInit(){
    // this is empty
  }

  login() {
    this.requestService.login(this.password, this.email).then(
      (res: any) => {
        console.log(res);
        if(res.rol === 'docente') {
          this.router.navigate(['/teacher'])
        } else if(res.rol === 'director') {
          this.router.navigate(['/director']);
        }
      }
    ).catch(err => console.log(err));
  }

}
