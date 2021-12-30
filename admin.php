<?php
session_start();
require 'fonctions.php';
if($_SESSION['user']['id_droits'] != '13'){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/profil.css" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <div class="containerProfil">
        <div class="container_change">
            <div class="change">
                <?php display_all_users(); ?>
            </div>
            <div class="change">
                <p class="text_change">Supprimez un utilisateur</p>
                <form action="" method="post">
                    <input class="input" type="text" name="id" placeholder="Id de l'utilisateur"/>
                    <button class="button">Supprimer</button>
                </form>
                <?php delete_user(); ?>
            </div>
        </div>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>