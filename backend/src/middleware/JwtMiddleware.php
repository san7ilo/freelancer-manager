<?php

require_once '../vendor/autoload.php'; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware {
    public function handle($request, Closure $next) {
        // Obtener el token del encabezado Authorization
        $headers = getallheaders();// Obtener todos los encabezados de la solicitud
        $token = isset($headers['Authorization']) ? trim(str_replace('Bearer', '', $headers['Authorization'])) : null;// Extraer el token del encabezado Authorization y elimina el bearer del token si esta presente y se obtiene un jwt limpio o en caso de no encontrarlo null

        if (!$token) {// se verifica si el token esta presente
            http_response_code(401);
            echo json_encode(['error' => 'Token no proporcionado']);
            exit;
        }

        try {
            // Decodificar el token JWT
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET, 'HS256'));
            $request->user = $decoded; // Asignar el usuario decodificado a la solicitud
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido: ' . $e->getMessage()]);
            exit;
        }

        // Pasar la solicitud al siguiente middleware o controlador
        return $next($request);
    }
}