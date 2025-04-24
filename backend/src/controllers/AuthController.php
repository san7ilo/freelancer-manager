<?php

class AuthController {
    private $db;
    private $requestMethod;

    public function __construct($dbConnection, $requestMethod) {
        $this->db = $dbConnection;
        $this->requestMethod = $requestMethod;
    }

    public function handleRequest() {
        switch ($this->requestMethod) {
            case 'POST':
                $this->register();
                break;
            case 'GET':
                $this->login();
                break;
            default:
                $this->response(405, "Method Not Allowed");
                break;
        }
    }

    private function register() {
        // Implementación del registro de usuario
        // Validar datos, guardar en la base de datos, etc.
    }

    private function login() {
        // Implementación del inicio de sesión
        // Validar credenciales, generar y devolver JWT, etc.
    }

    private function response($statusCode, $message) {
        http_response_code($statusCode);
        echo json_encode(['message' => $message]);
    }
}