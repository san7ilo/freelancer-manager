import { Component, OnInit } from '@angular/core';
import { ProjectService } from '../../../core/services/project.service';

@Component({
  selector: 'app-project-list',
  templateUrl: './project-list.component.html',
  styleUrls: ['./project-list.component.css']
})
export class ProjectListComponent implements OnInit {
  projects: any[] = [];
  userId: number = 1; // Asumimos que el userId está disponible en el frontend (esto puede ser gestionado con JWT)

  constructor(private projectService: ProjectService) { }

  ngOnInit(): void {
    this.getProjects();
  }

  getProjects(): void {
    this.projectService.getProjects(this.userId).subscribe({
      next: (data) => {
        this.projects = data;
      },
      error: (err) => {
        console.error('Error al cargar los proyectos:', err);
      }
    });
  }
}
