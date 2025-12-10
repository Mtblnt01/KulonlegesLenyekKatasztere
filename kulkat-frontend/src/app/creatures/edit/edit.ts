import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CreaturesService } from '../creatures';
import { CommonModule } from '@angular/common';
import { FormBuilder, ReactiveFormsModule, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-creature-edit',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './edit.html',
  styleUrl: './edit.css'
})
export class Edit implements OnInit {

  form!: FormGroup;

  loading = true;
  error = '';
  success = false;
  selectedFile: File | null = null;
  id!: number;

  constructor(
    private fb: FormBuilder,
    private route: ActivatedRoute,
    private creatures: CreaturesService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.id = Number(this.route.snapshot.paramMap.get('id'));

    this.form = this.fb.group({
      name: [''],
      category: [''],
      description: ['']
    });

    this.creatures.get(this.id).subscribe({
      next: (data: any) => {
        this.form.patchValue({
          name: data.name,
          category: data.category,
          description: data.description
        });
        this.loading = false;
      },
      error: () => {
        this.error = 'Hiba történt az adat betöltésekor.';
        this.loading = false;
      }
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

    this.creatures.update(this.id, data).subscribe({
      next: () => {
        this.success = true;
        setTimeout(() => {
          this.router.navigate(['/creatures', this.id]);
        }, 1200);
      },
      error: () => {
        this.error = 'Nem sikerült menteni a módosításokat.';
      }
    });
  }

  onFileChange(event: Event) {
    const input = event.target as HTMLInputElement;
    this.selectedFile = input?.files?.[0] ?? null;
  }
}
