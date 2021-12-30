<?php
session_start();
require 'fonctions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/index.css" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>
    <?php require 'header.php' ?>
<main>
    <div class="container">
        <h1 class="text_index">Bienvenue <?php if(isset($_SESSION['user'])){echo $_SESSION['user']['login'];}?> sur le livre d'or</h1>
        <p class="text_index2">Voici mon livre d'or utile pour toutes personnes souhaitant écrire un petit message :)</p>
        <p class="text_index2">Vous pouvez me commander la création de votre site avec livre d'or sur mon adresse mail hugo.chabert@laplateforme.fr pour seulement 50€ !!!</p>
        <p class="text_index2">L'apparence du site est customisable selon vos préférences.</p>
        <p class="text_index2">Cela peut être utile pour un baptême, un mariage ou même pour une personne que vous appréciez.</p>
    </div>
</main>
    <?php require 'footer.php' ?>
</body>
</html>