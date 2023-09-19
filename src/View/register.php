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
    <script defer src="scripts/scriptRegister.js"></script>
    <link rel="stylesheet" href="./style/register.css">
    <title>Register</title>
</head>
<body>  
    <div class="container">
        <div class="register-form">
            <h1 class="title">Register</h1>
            <form  method="post" id="register_form">

                <div class="field">
                    <input type="text" placeholder="Username" name="login" id="login">
                </div>

                <div class="field">
                    <input type="password" placeholder="Password" name="password" id="password">
                </div>

                <div class="field">
                    <input type="password" placeholder="Confirm password" name="password_conf" id="password_conf">
                </div>                

                <div class="field btn">
                    <input type="submit" value="Submit" id="submit_register">
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" required>
                    I agree to the terms & conditions</label>
                </div>

                <div class="error_msg">
                    <p id="error_login"></p>
                    <p id="error_password"></p>
                    <p id="error_password_conf"></p>
                    <p id="error_submit" ></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>