<?php

class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new Project();
    }

    public function createProject($data) {
        // Validar datos y crear un nuevo proyecto
        return $this->projectModel->create($data);
    }

    public function getProjects($userId) {
        // Obtener todos los proyectos del usuario
        return $this->projectModel->getAllByUserId($userId);
    }

    public function getProject($id) {
        // Obtener un proyecto por su ID
        return $this->projectModel->getById($id);
    }

    public function updateProject($id, $data) {
        // Actualizar un proyecto existente
        return $this->projectModel->update($id, $data);
    }

    public function deleteProject($id) {
        // Eliminar un proyecto
        return $this->projectModel->delete($id);
    }
}