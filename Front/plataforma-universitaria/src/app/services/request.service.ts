import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class RequestService {

  constructor(
    private readonly http: HttpClient,
  ) { }

  async login(password: string, user: string) {
    const login_url = environment.LOGIN_API;
    const body = {
      user: user,
      password: password
    }
    try {
      const res = await this.http.post(login_url, body).toPromise();
      return Promise.resolve(res);
    } catch (err) {
      return Promise.reject(err);
    }
  }

  async getStudents() {
    const students_API = environment.STUDENTS_API;
    try {
      const res = await this.http.get(students_API).toPromise();
      console.log('Estudiantes:', res);
      return Promise.resolve(res);
    } catch (err) {
      return Promise.reject(err);
    }
  }

  async getStats() {
    const stats_API = environment.STATS_API;
    try {
      const res = await this.http.get(stats_API).toPromise();
      console.log('Estadisticas:', res);
      return Promise.resolve(res);
    } catch (err) {
      return Promise.reject(err);
    }
  }
}
