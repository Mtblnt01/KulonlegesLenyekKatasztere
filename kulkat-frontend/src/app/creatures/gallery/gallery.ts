import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CreaturesService } from '../creatures';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-creature-gallery',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './gallery.html',
  styleUrl: './gallery.css'
})
export class Gallery implements OnInit {

  id!: number;
  images: any[] = [];
  loading = true;
  selectedFile: File | null = null;
  success = false;
  error = '';

  constructor(
    private route: ActivatedRoute,
    private creatures: CreaturesService
  ) {}

  ngOnInit(): void {
    this.id = Number(this.route.snapshot.paramMap.get('id'));
    this.loadGallery();
  }

  loadGallery() {
    this.creatures.getGallery(this.id).subscribe({
      next: (data) => {
        this.images = data;
        this.loading = false;
      },
      error: () => {
        this.error = 'Nem sikerült betölteni a galériát.';
        this.loading = false;
      }
    });
  }

  onFileChange(event: any) {
    this.selectedFile = event.target.files[0] ?? null;
  }

  upload() {
    if (!this.selectedFile) {
      this.error = 'Válassz ki egy képet!';
      return;
    }

    this.creatures.uploadImage(this.id, this.selectedFile).subscribe({
      next: () => {
        this.success = true;
        this.error = '';
        this.loadGallery(); // újratöltjük a képeket
      },
      error: () => {
        this.error = 'Hiba történt a feltöltés során.';
      }
    });
  }
}
