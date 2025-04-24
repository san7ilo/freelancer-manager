import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProjectService } from '../../../core/services/project.service';

@Component({
  selector: 'app-project-detail',
  templateUrl: './project-detail.component.html',
  styleUrls: ['./project-detail.component.css']
})
export class ProjectDetailComponent implements OnInit {
  project: any;

  constructor(
    private route: ActivatedRoute,
    private projectService: ProjectService
  ) { }

  ngOnInit(): void {
    const projectId = Number(this.route.snapshot.paramMap.get('id'));
    this.getProjectDetails(projectId);
  }

  getProjectDetails(id: number): void {
    this.projectService.getProjectById(id).subscribe({
      next: (data) => {
        this.project = data;
      },
      error: (err) => {
        console.error('Error al obtener detalles del proyecto:', err);
      }
    });
  }
}
