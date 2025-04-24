import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ProjectService } from '../../../core/services/project.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-project-form',
  templateUrl: './project-form.component.html',
  styleUrls: ['./project-form.component.css']
})
export class ProjectFormComponent implements OnInit {
  projectForm: FormGroup;
  isEditMode: boolean = false;
  projectId: number | null = null;

  constructor(
    private fb: FormBuilder,
    private projectService: ProjectService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    this.projectForm = this.fb.group({
      title: ['', [Validators.required]],
      description: ['', [Validators.required]],
      start_date: ['', [Validators.required]],
      end_date: ['', [Validators.required]],
      status: ['', [Validators.required]],
    });
  }

  ngOnInit(): void {
    this.projectId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.projectId) {
      this.isEditMode = true;
      this.getProjectDetails(this.projectId);
    }
  }

  getProjectDetails(id: number): void {
    this.projectService.getProjectById(id).subscribe({
      next: (data) => {
        this.projectForm.patchValue(data);
      },
      error: (err) => {
        console.error('Error al obtener detalles del proyecto:', err);
      }
    });
  }

  onSubmit(): void {
    if (this.projectForm.valid) {
      if (this.isEditMode) {
        this.projectService.updateProject(this.projectId!, this.projectForm.value).subscribe({
          next: () => this.router.navigate(['/projects']),
          error: (err) => console.error('Error al actualizar proyecto:', err),
        });
      } else {
        this.projectService.createProject(this.projectForm.value).subscribe({
          next: () => this.router.navigate(['/projects']),
          error: (err) => console.error('Error al crear proyecto:', err),
        });
      }
    }
  }
}
