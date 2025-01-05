<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $passwordDB = "";
    $dbname = "db_userdetails";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $passwordDB);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $confirmPassword = $_POST['ConfirmPassword'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["success" => false, "message" => "Invalid email format."]);
            exit();
        }

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_login WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(["success" => false, "message" => "An account with this email already exists."]);
            exit();
        }

        // Validate passwords
        if ($password !== $confirmPassword) {
            echo json_encode(["success" => false, "message" => "Passwords do not match."]);
            exit();
        }

        if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,8}$/", $password)) {
            echo json_encode(["success" => false, "message" => "Password must be 6-8 characters long, include one uppercase letter, one number, and one special character."]);
            exit();
        }

        // Save to database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO user_login (Email, Password) VALUES (:email, :password)");
        $stmt->execute(['email' => $email, 'password' => $hashedPassword]);

        echo json_encode(["success" => true, "message" => "Registration successful!"]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        exit();
    }
}
?>
