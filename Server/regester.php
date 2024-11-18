<?php
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $stmt->execute([$username, $passwordHash]);
    
} catch (PDOException $e) {
    
}
