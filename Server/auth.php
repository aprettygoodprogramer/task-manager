<?php
require_once 'db.php';

function addUser($username, $password) {
    $pdo = connectDatabase();
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $passwordHash,
        ]);
        echo "User successfully registered!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23505) { // Unique violation error for PostgreSQL
            echo "Username already exists!";
        } else {
            echo "Error adding user: " . $e->getMessage();
        }
    }
}

function login($username, $password) {
    $pdo = connectDatabase();
    $sql = "SELECT password_hash FROM users WHERE username = :username";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error during login: " . $e->getMessage();
        return false;
    }
}
?>
