<?php
header('Content-Type: application/json'); // Ensure the response is JSON
header('Access-Control-Allow-Origin: *'); // Allow requests from other origins (frontend)

// Include your database connection function
require_once 'connectDatabase.php';

// Create a PDO instance
$pdo = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM tasks");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks); 
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true); 
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
    $stmt->execute([
        ':title' => $input['title'],
        ':description' => $input['description']
    ]);
    echo json_encode(['message' => 'Task added successfully']);
} else {
    http_response_code(405); 
    echo json_encode(['error' => 'Method not allowed']);
}
?>
