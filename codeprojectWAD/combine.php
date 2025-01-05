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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form id="signup">
        <label for="email">Email</label>
        <input type="text" id="email" name="Email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="Password" required>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="ConfirmPassword" required>

        <button type="submit">Sign Up</button>
    </form>

    <script>
        document.getElementById('signup').addEventListener('submit', async function (e) {
            e.preventDefault(); // Prevent default form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        Email: email,
                        Password: password,
                        ConfirmPassword: confirmPassword,
                    }),
                });

                const result = await response.json();

                if (!result.success) {
                    // Display error as a popup
                    alert(result.message);
                } else {
                    // Success popup and redirect
                    alert(result.message);
                    window.location.href = 'dashboard.php'; // Redirect to dashboard
                }
            } catch (error) {
                console.error('Error submitting the form:', error);
                alert('An unexpected error occurred. Please try again later.');
            }
        });
    </script>
</body>
</html>
