import { Routes } from '@angular/router';
import { ProjectListComponent } from './pages/projects/project-list/project-list.component';
import { ProjectDetailComponent } from './pages/projects/project-detail/project-detail.component';
import { ProjectFormComponent } from './pages/projects/project-form/project-form.component';

export const routes: Routes = [
  { path: '', component: ProjectListComponent },
  { path: 'project/:id', component: ProjectDetailComponent },
  { path: 'project-form', component: ProjectFormComponent },
];
