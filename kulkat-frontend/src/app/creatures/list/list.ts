import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CreaturesService } from '../creatures';
import { Router } from '@angular/router';

@Component({
  selector: 'app-creature-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './list.html',
  styleUrl: './list.css'
})
export class List implements OnInit {

  creatures: any[] = [];
  loading = true;

  constructor(
    private creaturesService: CreaturesService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.creaturesService.getAll().subscribe({
      next: (data: any) => {
        this.creatures = data;
        this.loading = false;
      },
      error: () => {
        this.loading = false;
      }
    });
  }

  view(id: number) {
    this.router.navigate(['/creatures', id]);
  }

  edit(id: number) {
    this.router.navigate(['/creatures', id, 'edit']);
  }
}
