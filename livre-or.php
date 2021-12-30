<?php
session_start();
require 'fonctions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/livre-or.css" rel="stylesheet">
    <title>Livre d'or</title>
</head>
<body>
    <?php require 'header.php'?>
<main>
    <?php if(isset($_SESSION['user'])){?>
    <div class="text">
        <a href="commentaire.php" class="go_to_com">Ecrivez un commentaire ici !!</a>
    </div>
    <?php
    }
    ?>
    </div>
    <div class="container_com">
        <?php display_com();?>
    </div>
</main>
    <?php require 'footer.php'?>
</body>
</html>