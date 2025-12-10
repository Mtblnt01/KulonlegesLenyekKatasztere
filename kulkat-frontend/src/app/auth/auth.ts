import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) {}

  login(data: { email: string; password: string }) {
    return this.http.post('/api/login', data);
  }

  logout() {
    return this.http.post('/api/logout', {});
  }
}
