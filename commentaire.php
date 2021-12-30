<?php
session_start();
require 'fonctions.php';
if(!isset($_SESSION['user'])){
    header('Location: livre-or.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/commentaire.css" rel="stylesheet">
    <title>Ecrire un commentaire</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <div class="write_com">
        <form method="post" class="commentaire">
            <?php new_com();?>
            <a class="comm" >Votre commentaire :<br />
                <textarea class = "send_com" name="commentaire" rows="10%" cols="90%"></textarea>
            </a>
            <button class = 'button' type="submit" name="send_com"> Envoyer </button>
        </form>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>