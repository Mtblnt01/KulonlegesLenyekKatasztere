import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CreaturesService } from '../creatures';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-creature-details',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './details.html',
  styleUrl: './details.css'
})
export class Details implements OnInit {

  creature: any = null;
  loading = true;

  constructor(
    private route: ActivatedRoute,
    private creatures: CreaturesService,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));

    this.creatures.get(id).subscribe({
      next: (data) => {
        this.creature = data;
        this.loading = false;
      },
      error: () => {
        this.loading = false;
      }
    });
  }

  edit() {
    this.router.navigate(['/creatures', this.creature.id, 'edit']);
  }

  openGallery() {
    this.router.navigate(['/creatures', this.creature.id, 'gallery']);
  }

  delete() {
    if (!confirm('Biztos törlöd?')) return;

    this.creatures.delete(this.creature.id).subscribe(() => {
      this.router.navigate(['/creatures']);
    });
  }
}
