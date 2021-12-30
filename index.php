<?php
session_start();
require 'fonctions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <?php require 'header.php' ?>
<main>
    <h1>Bienvenue <?php if(isset($_SESSION['user'])){echo $_SESSION['user']['login'];}?> sur le livre d'or</h1>
</main>
    <?php require 'footer.php' ?>
</body>
</html>