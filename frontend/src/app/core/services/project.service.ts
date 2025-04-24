// src/app/core/services/project.service.ts

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProjectService {
  private apiUrl = 'http://localhost/api/projects';  // Cambiar según la URL de tu backend

  constructor(private http: HttpClient) { }

  // Obtener todos los proyectos
  getProjects(userId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}?userId=${userId}`);
  }

  // Obtener un proyecto por su ID
  getProjectById(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`);
  }

  // Crear un nuevo proyecto
  createProject(projectData: any): Observable<any> {
    return this.http.post(this.apiUrl, projectData);
  }

  // Actualizar un proyecto
  updateProject(id: number, projectData: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/${id}`, projectData);
  }

  // Eliminar un proyecto
  deleteProject(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }
}
