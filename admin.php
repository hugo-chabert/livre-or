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
    <title>Admin</title>
</head>
<body>
    <?php require 'header.php'?>
<main>

</main>
    <?php require 'footer.php'?>
</body>
</html>