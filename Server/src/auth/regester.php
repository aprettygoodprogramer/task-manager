<?php
require_once '../database.php';
require_once '../functions.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username'], $data['password'], $data['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$username = $data['username'];
$password = hashPassword($data['password']);
$email = $data['email'];

$db = getDatabaseConnection();

$query = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
try {
    $query->execute([$username, $password, $email]);
    echo json_encode(['message' => 'User registered successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
