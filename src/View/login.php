<?php
if(!isset($_SESSION)){
    session_start();
}
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/scriptLogin.js"></script>
    <link rel="stylesheet" href="./style/login.css">
    <title>Login</title>
</head>
<body>
    <div class = "container">
        <div class = "login-form">
            <h1 class="title">Login</h1>
            <form  method="post" id="login_form">

                <div class="field">
                    <label for="login">Username</label>
                    <input type="text" placeholder="Username" name="login" id="login_login">
                </div>
                
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password_login" id="password_login">
                </div>

                <div class="field btn">
                    <input type="submit" value="Login" id="submit_login">
                </div>

                <div class="signup-link">
                    Not a member? <a href="register">Register</a>
                </div>

                <div class="error_msg">
                    <p id="error_form_login" ></p>
                </div>

                <div class="success_msg">
                    <p id="success_form_login" ></p>
                </div>

            </form>
        </div>
    </div>
</body>
</html>