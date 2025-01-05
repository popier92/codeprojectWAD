<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="css/Signup.css">
</head>
<body>
    <div class="left-section">
        <form class="form-position" id="signup" method="post" action="Register.php">
            <h1>Sign Up</h1>
            <img id="user" src="icon/user.png" alt="IconSignup">

            <label for="email">Email</label>
            <input type="text" id="email" name="Email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="Password" required>
            <p>6-8 characters, one uppercase, one number, one special character, no spaces</p>

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="ConfirmPassword" required>

            <div class="button-container">
                <a href="MainLogin.php" class="button">Cancel</a>
                <button class="button2" type="submit" name="Confirm">Confirm</button>
            </div>
        </form>
    </div>

    <div class="right-section">
        <img id="laksa" src="icon/Laksa1rb.png" alt="Laksa Image">
    </div>

    <script src="javascript/Signup.js"></script>
</body>
</html>
