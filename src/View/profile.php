<?php
if(!isset($_SESSION)){
    session_start();
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/scriptProfile.js"></script>
    <title>Profile</title>
</head>
<body>
    <?php
        require_once "header.php";
        var_dump($_SESSION)
    ?>

    <form method="post" id="login_form">

        <label for="login">Login</label>
        <input type="text" name="login" id="login_profile" value="<?= $_SESSION["user"]["login"]?>">
        <span id="error_profile"></span>

        <label for="password">New password</label>
        <input type="password" name="password_profile" id="password_profile">
        <span id="error_password" ></span>

        <label for="password">Password confirmation</label>
        <input type="password" name="password_profile_conf" id="password_profile_conf">
        <span id="error_password_conf" ></span>

        <input type="submit" value="Submit" id="submit_profile">

        <p id="error_profile"></p>
        
    </form>
</body>
</html>