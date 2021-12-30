<?php
session_start();
require 'fonctions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/profil.css" rel="stylesheet">
    <title>Profil</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <div class="containerProfil">
        <div class="container_change">
            <div class="change">
                <p class="text_change">Changez votre login</p>
                <form action="" method="post">
                    <input class="input" type="text" name="Nlogin" placeholder="Nouveau Login"/>
                    <button class="button">Changer le login</button>
                </form>
                <?php change_login(); ?>
            </div>
            <div class="change">
                <p class="text_change">Changez votre Mot de Passe</p>
                <form action="" method="post">
                    <input class="input" type="text" name="password" placeholder="Ancien Mot de Passe"/>
                    <input class="input" type="text" name="Npassword" placeholder="Nouveau Mot de Passe"/>
                    <input class="input" type="text" name="CNpassword" placeholder="Confirmez le nouveau Mot de Passe"/>
                    <button class="button">Changer le mot de passe</button>
                </form>
                <?php change_password(); ?>
            </div>
        </div>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>