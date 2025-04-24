<?php

require_once '../config/Database.php';

class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function save() {
         // Validar que el email sea único
        Validator::validateUniqueEmail($this->email);
        $databaseConnection = Database::getConnection(); // Obtener la conexión a la base de datos
        // Insertar un nuevo usuario
        $insertStatement = $databaseConnection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertStatement->execute([$this->name, $this->email, $this->password]);
        $this->id = $databaseConnection->lastInsertId(); // Obtener el ID generado
    }

    public static function findByEmail($email) {
        $databaseConnection = Database::getConnection(); // Obtener la conexión a la base de datos
        $selectStatement = $databaseConnection->prepare("SELECT * FROM users WHERE email = ?");
        $selectStatement->execute([$email]);
        $userRecord = $selectStatement->fetch(PDO::FETCH_ASSOC);

        if ($userRecord) {
            $user = new User($userRecord['name'], $userRecord['email'], $userRecord['password']);
            $user->setId($userRecord['id']);
            return $user;
        }

        return null; // Retorna null si no se encuentra el usuario
    }
}