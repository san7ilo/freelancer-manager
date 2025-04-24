<?php

require_once '../vendor/autoload.php'; // Asegúrate de que el autoloader de Composer esté incluido
require_once '../helpers/Validator.php';
require_once '../models/User.php';
require_once '../services/AuthService.php';

use Firebase\JWT\JWT;

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
        $data = json_decode(file_get_contents("php://input"), true);

        try {
            // Validar datos usando Validator
            Validator::validateRegisterData($data);

            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            // Verificar si el usuario ya existe
            $existingUser = User::findByEmail($email);
            if ($existingUser) {
                $this->response(409, "El usuario ya está registrado");
                return;
            }

            // Crear y guardar el usuario
            $user = new User($name, $email, $password);
            $user->save();

            $this->response(201, "Usuario registrado exitosamente");
        } catch (Exception $e) {
            $this->response(400, $e->getMessage());
        }
    }

    private function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        try {
            // Validar datos usando Validator
            Validator::validateLoginData($data);

            $email = $data['email'];
            $password = $data['password'];

            // Buscar al usuario por email
            $user = User::findByEmail($email);
            if (!$user || !$user->verifyPassword($password)) {
                $this->response(401, "Credenciales inválidas");
                return;
            }

            // Generar JWT
            $payload = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'exp' => time() + 3600 // Token válido por 1 hora
            ];
            $token = JWT::encode($payload, Config::JWT_SECRET, 'HS256');

            $this->response(200, ['token' => $token]);
        } catch (Exception $e) {
            $this->response(400, $e->getMessage());
        }
    }

    private function response($statusCode, $message) {
        http_response_code($statusCode);
        echo json_encode(['message' => $message]);
    }
}