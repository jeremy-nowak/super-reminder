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
    <script src="scripts/scriptProfile.js"></script>
    <link rel="stylesheet" href="./style/profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <div class="profile-form">
            <h1 class="title">My Profile</h1>
            <form method="post" id="login_form">

                <div class="field">
                    <label for="login">Username</label>
                    <input type="text" placeholder="Username" name="login" id="login_profile" value="<?= $_SESSION["user"]["login"]?>">
                </div>

                <div class="field">
                    <label for="password">New password</label>
                    <input type="password" placeholder="New Password" name="password_profile" id="password_profile">
                </div>

                <div class="field">
                    <label for="password">Password Confirmation</label>
                    <input type="password" placeholder="Confirm Password" name="password_profile_conf" id="password_profile_conf">
                </div>

                <div class="field btn">
                    <input type="submit" value="Save" id="submit_profile">
                </div>

                <div class="success_msg">
                    <p id="success_form_profile" ></p>
                </div>

                <div class="error_msg">
                    <p id="error_form_profile" ></p>
                </div>

                <div class="error_msg">
                    <p id="error_password" ></p>
                </div>

                <div class="error_msg">
                    <p id="error_password_conf" ></p>
                </div>

                <div class="error_msg">
                    <p id="error_profile" ></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>