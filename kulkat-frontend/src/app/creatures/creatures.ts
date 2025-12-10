import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CreaturesService {

  constructor(private http: HttpClient) {}

  getAll() {
    return this.http.get<any[]>('/api/creatures');
  }

  get(id: number) {
    return this.http.get<any>(`/api/creatures/${id}`);
  }

  create(data: FormData) {
    return this.http.post('/api/creatures', data);
  }

  update(id: number, data: FormData) {
    return this.http.put(`/api/creatures/${id}`, data);
  }

  delete(id: number) {
  return this.http.delete(`/api/creatures/${id}`);
  }

  getGallery(id: number) {
  return this.http.get<any[]>(`/api/creatures/${id}/gallery`);
}

  uploadImage(id: number, file: File) {
    const formData = new FormData();
    formData.append('image', file);

    return this.http.post(`/api/creatures/${id}/gallery`, formData);
  }
}
