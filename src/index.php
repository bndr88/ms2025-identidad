<?php
require 'auth.php';

header('Content-Type: application/json');

// Obtener método y ruta
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Endpoint para health check
if ($uri === '/health') {
    http_response_code(200);
    echo json_encode(['status' => 'ok']);
    exit;
}

// Leer datos JSON solo para otros métodos (por ejemplo, POST)
$data = json_decode(file_get_contents('php://input'), true);

// Verifica si username y password están presentes
if ($uri != '/health' && !isset($data['username']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required.']);
    exit;
}

// Autenticación
if (authenticate($data['username'], $data['password'])) {
    $token = generateToken($data['username']);
    echo json_encode(['token' => $token]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials.']);
}