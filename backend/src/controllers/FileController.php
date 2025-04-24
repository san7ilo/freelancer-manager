<?php
require_once __DIR__ . '/../models/File.php';

class FileController {
    private $fileModel;

    public function __construct() {
        $this->fileModel = new File();
    }

    // Subir archivo
    public function uploadFile($request) {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file = $_FILES['file'];
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            
            // Validar tipo de archivo (PDF, imagenes, docs)
            $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'doc', 'docx'];
            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                return ['error' => 'Tipo de archivo no permitido.'];
            }
    
            $filePath = 'uploads/' . $file['name']; // Ruta donde se guarda el archivo
            move_uploaded_file($file['tmp_name'], $filePath);
    
            // Guardar la información del archivo en la base de datos
            $this->fileModel = new File($request['project_id'], $filePath);
            if ($this->fileModel->save()) {
                return ['success' => 'Archivo subido exitosamente'];
            }
        }
        return ['error' => 'Error al subir el archivo'];
    }
    

    // Descargar archivo
    public function downloadFile($fileId) {
        try {
            // Obtener el archivo por su ID
            $file = $this->fileModel->findById($fileId);
            if ($file) {
                $filePath = $file['file_path'];
                if (file_exists($filePath)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                    readfile($filePath);
                    exit;
                }
            }
            return ['error' => 'Archivo no encontrado'];
        } catch (Exception $e) {
            return ['error' => 'Error al descargar el archivo: ' . $e->getMessage()];
        }
    }

    // Eliminar archivo
    public function deleteFile($fileId) {
        try {
            $this->fileModel->setId($fileId);
            if ($this->fileModel->delete()) {
                return ['success' => 'Archivo eliminado exitosamente'];
            }
            return ['error' => 'Error al eliminar el archivo'];
        } catch (Exception $e) {
            return ['error' => 'Error al eliminar el archivo: ' . $e->getMessage()];
        }
    }

    // Listar archivos de un proyecto
    public function listFiles($projectId) {
        return $this->fileModel->findByProjectId($projectId);
    }
}
?>
