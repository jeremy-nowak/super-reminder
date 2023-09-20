<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/header.css">
    <script src="./scripts/scriptHeader.js"></script>
</head>

<body>
    <header id="header">

        <nav class= "top_nav">
            <ul>
            <?php if (!isset($_SESSION['user'])) { ?>
                <li><a href="./">Home</a></li>
                <li><a href="./register">Register</a></li>
                <li><a href="./login">Login</a></li>

            <?php } else { ?>
                <li><a href="./">Home</a></li>
                <li><a href="./myList">My list</a></li>
                <li><a href="./profile">Profile</a></li>
                <li><a href="./logout">Logout</a></li>
                <li><a href="./myList">Create task</a></li>

            <?php } ?>
            </ul>
        </nav>
    </header>
</body>