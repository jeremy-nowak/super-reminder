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
    <!-- <script defer src="scripts/scriptProfil.js"></script> -->
    <script src="scripts/scriptProfil.js"></script>
    <title>Profil</title>
</head>
<body>
    <?php
        require_once "header.php";
        var_dump($_SESSION)
    ?>

<form method="post" id="login_form">

    <label for="login">Login</label>
    <input type="text" name="login" id="login_profil" value="<?= $_SESSION["user"]["login"]?>">
    <span id="error_profil"></span>

    <label for="firstname">Firstname</label>
    <input type="text" name="firstname" id="firstname_profil" value="<?= $_SESSION["user"]["firstname"]?>">
    
    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" id="lastname_profil"value="<?= $_SESSION["user"]["lastname"]?>" >

    <label for="password">New password</label>
    <input type="password" name="password_profil" id="password_profil">
    <span id="error_password" ></span>

    <label for="password">Password confirmation</label>
    <input type="password" name="password_profil_conf" id="password_profil_conf">
    <span id="error_password_conf" ></span>

    <input type="submit" value="Submit" id="submit_profil">

    <p id="error_profil"></p>

</form>
    
</body>
</html>