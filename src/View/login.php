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
    <link rel="stylesheet" href="/style/style.css">
    <title>Login</title>
</head>
<body>
    
    <form  method="post" id="login_form">

        <label for="login">Login</label>
        <input type="text" name="login" id="login_login">

        <label for="password">Password</label>
        <input type="password" name="password_login" id="password_login">

        <input type="submit" value="Submit" id="submit_login">
        <p id="error_form_login" ></p>

    </form>
</body>
</html>