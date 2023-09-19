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
    <form  method="post" id="register_form">

        <label for="login">Login:</label>
        <input type="text" name="login" id="login">
        <p id="error_login"></p>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <p id="error_password"></p>

        <label for="password_conf">Password confirmation:</label>
        <input type="password" name="password_conf" id="password_conf"><br>
        <p id="error_password_conf"></p>

        <input type="submit" value="Submit" id="submit_register">
        <p id="error_submit" ></p>
    </form>
</body>
</html>