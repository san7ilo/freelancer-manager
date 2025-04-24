// src/app/core/services/file.service.ts

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FileService {
  private apiUrl = 'http://localhost/api/files';  // Cambiar según la URL de tu backend

  constructor(private http: HttpClient) { }

  // Subir un archivo
  uploadFile(projectId: number, formData: FormData): Observable<any> {
    return this.http.post(`${this.apiUrl}/upload/${projectId}`, formData);
  }

  // Obtener archivos de un proyecto
  getFilesByProjectId(projectId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}?projectId=${projectId}`);
  }

  // Descargar un archivo
  downloadFile(fileId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/download/${fileId}`, { responseType: 'blob' });
  }

  // Eliminar un archivo
  deleteFile(fileId: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete/${fileId}`);
  }
}
