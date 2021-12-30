<?php
session_start();
require 'fonctions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/inscription.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <div class="login-page">
        <div class="form">
            <form action="" method="post">
                <input type="text" name="login" placeholder="Login"/>
                <input type="password" name="password" placeholder="Mot de passe"/>
                <button>Connexion</button>
                <p class="message">Vous n'avez pas de compte? <a class="aa" href="inscription.php">Creez un compte</a></p>
            </form>
            <?php connect_user()?>
        </div>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>