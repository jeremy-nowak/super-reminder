<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <script src="./scripts/scriptHeader.js"></script>
</head>

<body>

    <header id="header">
        <nav>
            <a href="./">Home</a>
            <a href="./register">Register</a>
            <a href="./login">Login</a>
            <?php
            if (isset($_SESSION["user"])) {
            ?>
                <a href="./logout">Logout</a>
                <a href="./profile">Profile</a>
            <?php
            }
            ?>

        </nav>
    </header>
</body>