<?php
session_start();
include 'asset/connect.php'; // Ensure this file sets up $pdo

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['Password']);

    if (empty($email) || empty($password)) {
        $error_message = 'Email and password are required.';
    } else {
        try {
            // Fetch user from database
            $stmt = $pdo->prepare("SELECT user_id, password_hash, role FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password_hash'])) {
                    // Start session and set variables
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['role'] = $user['role'];
                    session_regenerate_id(true);

                    // Redirect based on role
                    if ($user['role'] === 'admin') {
                        header('Location: addashboard.php');
                    } elseif ($user['role'] === 'customer') {
                        header('Location: cusdashboard.php');
                    } else {
                        $error_message = 'Unexpected role. Please contact support.';
                    }
                    exit();
                } else {
                    $error_message = 'Invalid email or password.';
                }
            } else {
                $error_message = 'Invalid email or password.';
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $error_message = 'An error occurred. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/Login.css">
</head>
<body>
    <div class="left-section">
        <!-- Login Form -->
        <form class="form-position" id="loginForm" method="post">
            <h1>Login</h1>
            <img id="user" src="icon/user.png" alt="IconLogin">

            <!-- Error message container for JavaScript -->
            <div id="jsErrorContainer" style="color: red;"></div>

            <!-- PHP Error Message -->
            <?php if (!empty($error_message)) { echo '<div style="color: red;">' . $error_message . '</div>'; } ?>

            <!-- Email Input -->
            <label for="Email">Email</label>
            <input type="email" id="Email" name="Email" required placeholder="Enter your email">

            <!-- Password Input -->
            <label for="Password">Password</label>
            <input type="password" id="Password" name="Password" required placeholder="Enter your password">

            <!-- Forgot Password Link -->
            <div class="forgot-password">
                <a href="Forgotpass.html">Forgot Password?</a>
            </div>

            <!-- Buttons -->
            <div class="button-container">
                <a href="Signup.php" class="button">Signup</a>
                <button class="button2" type="submit" name="Confirm">Confirm</button>
            </div>
        </form>
    </div>

    <div class="right-section">
        <img id="laksa" src="icon/Laksa1rb.png" alt="laksa in login">
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const emailField = document.getElementById('Email');
            const passwordField = document.getElementById('Password');
            const errorContainer = document.getElementById('jsErrorContainer');

            const email = emailField.value.trim();
            const password = passwordField.value.trim();

            // Clear previous error messages
            errorContainer.textContent = '';

            let isValid = true;

            // Email validation
            if (!email) {
                errorContainer.textContent = 'Email is required.';
                emailField.focus();
                isValid = false;
            } else if (!validateEmail(email)) {
                errorContainer.textContent = 'Invalid email format.';
                emailField.focus();
                isValid = false;
            }

            // Password validation
            if (!password) {
                errorContainer.textContent = 'Password is required.';
                passwordField.focus();
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Function to validate email format
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
</body>
</html>
