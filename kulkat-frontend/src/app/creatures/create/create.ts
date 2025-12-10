import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { CreaturesService } from '../creatures';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-creature-create',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './create.html',
  styleUrls: ['./create.css']
})
export class Create {

  success = false;
  error = '';
  selectedFile: File | null = null;

  form: FormGroup;

  constructor(
    private fb: FormBuilder,
    private creatures: CreaturesService,
    private router: Router
  ) {
    this.form = this.fb.group({
      name: [''],
      category: [''],
      description: ['']
    });
  }

  onSubmit() {
    const data = new FormData();

    data.append('name', this.form.value.name || '');
    data.append('category', this.form.value.category || '');
    data.append('description', this.form.value.description || '');

    if (this.selectedFile) {
      data.append('image', this.selectedFile);
    }

    this.creatures.create(data).subscribe({
      next: () => {
        this.success = true;
        setTimeout(() => {
          this.router.navigate(['/creatures']);
        }, 1200);
      },
      error: () => {
        this.error = 'Hiba történt a létrehozás során.';
      }
    });
  }

  onFileChange(event: Event) {
    const input = event.target as HTMLInputElement;
    this.selectedFile = input?.files?.[0] ?? null;
  }
}
