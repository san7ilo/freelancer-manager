<?php

require_once '../models/User.php';

class Validator {
    public static function validateRegisterData($data) {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception("Todos los campos son obligatorios");
        }
    }

    public static function validateLoginData($data) {
        if (empty($data['email']) || empty($data['password'])) {
            throw new Exception("Email y contraseña son obligatorios");
        }
    }

    public static function validateUniqueEmail($email) {
        $existingUser = User::findByEmail($email);
        if ($existingUser) {
            throw new Exception("El email '$email' ya está registrado.");
        }
    }
}