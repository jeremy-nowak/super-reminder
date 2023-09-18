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
            <a href="./register">Inscription</a>
            <a href="./login">Connexion</a>
            <?php
            if (isset($_SESSION["user"])) {
            ?>
                <a href="./logout">Deconnexion</a>
                <a href="./profil">Profil</a>
            <?php
            }
            ?>



        </nav>
    </header>
</body>