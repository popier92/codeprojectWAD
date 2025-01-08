<?php
// Load environment variables
$servername = getenv('DB_HOST') ?: 'sql209.infinityfree.com';
$username = getenv('DB_USER') ?: 'if0_38042508';
$password = getenv('DB_PASS') ?: 'OPhQ0F3THq6o2C';
$dbname = getenv('DB_NAME') ?: 'if0_38042508_db_system';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=sql209.infinityfree.com;dbname=if0_38042508_db_system;charset=utf8mb4", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Log successful connection (remove in production)
    // error_log("Database connected successfully.");
} catch (PDOException $e) {
    // Log the error instead of displaying it
    error_log("Database connection error: " . $e->getMessage(), 3, 'errors.log');
    die("A database connection error occurred. Please try again later.");
}
?>
