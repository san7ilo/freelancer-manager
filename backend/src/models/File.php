<?php
require_once __DIR__ . '/../config.php';

class File {
    private $id;
    private $projectId;
    private $filePath;
    private $createdAt;
    private $conn;

    public function __construct($projectId = null, $filePath = null) {
        $this->conn = (new Database())->getConnection();  // Conexión a la base de datos
        $this->projectId = $projectId;
        $this->filePath = $filePath;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getProjectId() {
        return $this->projectId;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    // Agregar el setter para id
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    // Agregar el método findById
    public function findById($id) {
        $query = "SELECT * FROM files WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar archivo en la base de datos
    public function save() {
        $query = "INSERT INTO files (project_id, file_path, created_at) VALUES (:project_id, :file_path, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':project_id', $this->projectId);
        $stmt->bindParam(':file_path', $this->filePath);
        $stmt->bindParam(':created_at', $this->createdAt);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Eliminar archivo de la base de datos
    public function delete() {
        $query = "DELETE FROM files WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Obtener archivos por projectId
    public static function findByProjectId($projectId) {
        $query = "SELECT * FROM files WHERE project_id = :project_id";
        $stmt = (new Database())->getConnection()->prepare($query);
        $stmt->bindParam(':project_id', $projectId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
