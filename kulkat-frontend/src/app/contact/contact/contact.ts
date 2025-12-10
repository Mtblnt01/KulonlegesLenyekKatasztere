import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-contact',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './contact.html',
  styleUrl: './contact.css'
})
export class Contact {

  form = {
    name: '',
    email: '',
    message: ''
  };

  success = false;

  constructor(private http: HttpClient) {}

  submit() {
    this.http.post('/api/contact', this.form).subscribe({
      next: () => {
        this.success = true;
        this.form = { name: '', email: '', message: '' };
      },
      error: (err) => {
        console.error(err);
      }
    });
  }
}
