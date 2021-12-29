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
    <title>Ecrire un commentaire</title>
</head>
<body>
    <?php require 'header.php'?>
<main>

</main>
    <?php require 'footer.php'?>
</body>
</html>