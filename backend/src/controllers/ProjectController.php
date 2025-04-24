<?php
require_once __DIR__ . '/../models/Project.php';

class ProjectController {
    public function createProject($data) {
        // Validación de datos antes de crear el proyecto
        if (empty($data['title']) || empty($data['description']) || 
            empty($data['start_date']) || empty($data['end_date']) || 
            empty($data['status']) || empty($data['user_id'])) {
            return ['error' => 'Faltan datos necesarios.'];
        }

        try {
            // Crear instancia del proyecto con los datos
            $project = new Project(
                $data['title'],
                $data['description'],
                $data['start_date'],
                $data['end_date'],
                $data['status'],
                $data['user_id']
            );

            // Crear el proyecto
            if ($project->create()) {
                return ['success' => true, 'message' => 'Proyecto creado exitosamente'];
            }
            return ['error' => 'No se pudo crear el proyecto'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getProjects($userId) {
        return Project::getAllByUserId($userId);
    }

    public function getProject($id) {
        return Project::getById($id);
    }

    public function updateProject($id, $data) {
        // Validación de datos antes de actualizar
        if (empty($data['title']) || empty($data['description']) || 
            empty($data['start_date']) || empty($data['end_date']) || 
            empty($data['status'])) {
            return ['error' => 'Faltan datos necesarios.'];
        }

        return Project::update($id, $data);
    }

    public function deleteProject($id) {
        return Project::delete($id);
    }
}
