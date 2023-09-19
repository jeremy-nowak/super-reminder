<?php
if(!isset($_SESSION)){
    session_start();
}

require_once "header.php";
if (isset($_SESSION['user'])) {
    var_dump($_SESSION['user']);    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/home.css">
    <script src="scripts/scriptLogin.js"></script>
    <title  >My ToDoList </title>
</head>
<body>
    <main class="home">
        <?php if (!isset($_SESSION['login'])) { ?>
            <h1>Welcome to the project</h1>

        <?php } else { ?>
            <h1><?php echo 'Welcome back </br>' . $_SESSION['login'] ?></h1>
        <?php } ?>
    </main>


</body>
</html>
