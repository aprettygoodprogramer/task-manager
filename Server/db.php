<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function connectDatabase() {
    $host = $_ENV['DATABASE_HOST'];
    $db   = $_ENV['DATABASE_NAME'];
    $user = $_ENV['DATABASE_USER'];
    $pass = $_ENV['DATABASE_PASS'];
    $port = $_ENV['DATABASE_PORT'];

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
