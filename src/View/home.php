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
    <script src="scripts/scriptLogin.js"></script>
    <title  >My ToDoList </title>
</head>
<body>

<p><h1>This is a home page</h1></p>

</body>
</html>
