<?php

class JwtMiddleware {
    public function handle($request, Closure $next) {
        $token = $request->headers->get('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        try {
            $decoded = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            $request->user = $decoded;
        } catch (Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        return $next($request);
    }
}