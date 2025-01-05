<?php
include 'asset/connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];//test test

    if (empty($email) || empty($password)) {
        echo "Invalid email or password"; // Response for JavaScript to handle
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT id, Password, role FROM user_login WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            session_regenerate_id(true);

            // Return location header for redirection
            if ($user['role'] === 'admin') {
                header("Location: addashboard.php") ;
            } else {
                header( "Location: cusdashboard.php");
            }
            exit();
        } else {
            echo "Invalid email or password"; // Response for JavaScript to handle
        }
    } catch (PDOException $e) {
        echo "Database error. Please try again later."; // Response for JavaScript to handle
    }
}
?>
