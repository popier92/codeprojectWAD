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
        <form class="form-position" id="login" method="post" action="Login.php">
            <h1>Login</h1>
            <img id="user" src="icon/user.png" alt="IconLogin">

            <label for="Email"> Email</label>
            <input type="text" id="Email" name="Email">

            <label for="Password"> Password</label>
            <input type="password" id="pwd" name="Password">
            <div class="forgot-password">
                <a href="Forgotpass.html">Forgot Password?</a>
            </div>

            <div class="button-container">
                <a href="Signup.php" class="button">Signup</a>
                <button class="button2" type="submit" value="Confirm" name="Confirm">Confirm</button>
            </div>
        </form>
    </div>

    <div class="right-section">
        <img id="laksa" src="icon/Laksa1rb.png" alt="laksa in login">
    </div>

    <script src="javascript/Login.js"></script>
</body>
</html>
