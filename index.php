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
    <h1>Bienvenue sur le livre d'or de Hugo Chabert</h1>
    <?php var_dump($_SESSION); ?>
</main>
    <?php require 'footer.php' ?>
</body>
</html>