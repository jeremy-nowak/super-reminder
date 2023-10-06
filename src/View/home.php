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
    <link rel="stylesheet" href="./style/style.css">
    <script src="scripts/scriptLogin.js"></script>
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />

    <script src="./scripts/scriptHeader.js"></script>
    <title>My To do list </title>
</head>

<body>
    <div class="container">

            <div class="hcontainer">
                <?php
                require_once "header.php";
                ?>
            </div>

            <div class="home">
                <?php if (!isset($_SESSION['user']['login'])) { ?>
                    <h1>Welcome to TodoList project</h1>

                <?php } else { ?>
                    <h1><?php echo 'Welcome back&nbsp;' . $_SESSION['user']['login'] ?></h1>
                <?php } ?>
            </div>

    </div>
</body>
</html>
