<?php
$servername = "localhost";
$username = "if0_38042508";
$password = "OPhQ0F3THq6o2C";
$dbname = "db_userdetails";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed404: " . $e->getMessage());
}
?>
