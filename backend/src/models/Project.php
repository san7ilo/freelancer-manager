<?php
require_once __DIR__ . '/../Database.php';

class Project {
    private $id;
    private $title;
    private $description;
    private $startDate;
    private $endDate;
    private $status;
    private $userId;

    public function __construct($title, $description, $startDate, $endDate, $status, $userId) {
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->userId = $userId;
    }

    // Getters y Setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    // Métodos de interacción con base de datos

    public function create() {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "INSERT INTO projects (title, description, start_date, end_date, status, user_id)
                VALUES (:title, :description, :startDate, :endDate, :status, :userId)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':userId', $this->userId);

        return $stmt->execute();
    }

    public static function getAllByUserId($userId) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM projects WHERE user_id = :userId ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM projects WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE projects SET title = :title, description = :description, start_date = :startDate,
                end_date = :endDate, status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':startDate', $data['start_date']);
        $stmt->bindParam(':endDate', $data['end_date']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function delete($id) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
