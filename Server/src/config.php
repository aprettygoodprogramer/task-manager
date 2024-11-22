<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // Adjust path if needed
$dotenv->load();

// Define database constants
define('DB_HOST', $_ENV['MYSQLHOST']);
define('DB_NAME', $_ENV['MYSQLDATABASE']);
define('DB_USER', $_ENV['MYSQLUSER']);
define('DB_PASS', $_ENV['MYSQLPASSWORD']);
define('DB_PORT', $_ENV['MYSQLPORT'] ?? 3306); // Default to 3306 if MYSQLPORT is not set
