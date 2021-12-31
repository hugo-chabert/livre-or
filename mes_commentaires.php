<?php
session_start();
require 'fonctions.php';
isConnected();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/profil.css" rel="stylesheet">
    <title>Mes commentaires</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <div class="containerProfil">
        <div class="container_change">
            <div class="change">
                <?php show_com(); ?>
            </div>
            <div class="change">
                <p class="text_change">Supprimez un de vos commentaires</p>
                <form action="" method="post">
                    <input class="input" type="text" name="id" placeholder="Id du commentaire"/>
                    <button class="button">Supprimer</button>
                </form>
                <?php delete_com(); ?>
            </div>
        </div>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>