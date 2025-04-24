class File {
    private $id;
    private $projectId;
    private $filePath;
    private $createdAt;

    public function __construct($projectId, $filePath) {
        $this->projectId = $projectId;
        $this->filePath = $filePath;
        $this->createdAt = date('Y-m-d H:i:s');
    }

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

    public function save() {
        // Aquí se implementaría la lógica para guardar el archivo en la base de datos
    }

    public function delete() {
        // Aquí se implementaría la lógica para eliminar el archivo de la base de datos
    }

    public static function findByProjectId($projectId) {
        // Aquí se implementaría la lógica para encontrar archivos por ID de proyecto
    }
}