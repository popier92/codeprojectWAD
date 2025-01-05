<?php
session_start();

// Function to check if the user is logged in and has a specific role
function checkUserRole($requiredRole, $redirectPage = 'Login.php') {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        // Redirect to login page if not authorized
        header("Location: $redirectPage");
        exit();
    }
}
?>
