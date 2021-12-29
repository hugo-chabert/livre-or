<link href="css/header.css" rel="stylesheet">
<header>
    <div class="header">
            <div class="containerHeader">LIVRE D'OR</div>
            <div class="links">
                <a href="index.php" class="linkHeader">ACCUEIL</a>
                <a href="livre-or.php" class="linkHeader">LIVRE D'OR</a>
                <?php if(!isset($_SESSION['user'])){echo '<a href="inscription.php" class="linkHeader">INSCRIPTION</a>';} ?>
                <?php if(!isset($_SESSION['user'])){echo '<a href="connexion.php" class="linkHeader">CONNEXION</a>';} ?>
                <?php if(isset($_SESSION['user'])){echo '<a href="profil.php" class="linkHeader">PROFIL</a>';} ?>
                <?php if(isset($_SESSION['user'])){if($_SESSION['user']['id_droits'] == '13'){echo '<a href="admin.php" class="linkHeader">ADMIN</a>';}} ?>
                <?php if(isset($_SESSION['user'])){echo '<form action="" method = "POST" class="decoButton">
                                                            <button class = "deco2" type = "submit" name = "deconnexion" value ="Deconnexion">DECONNEXION</button>
                                                        </form>';} ?>
            </div>
        </div>
</header>
<?php disconnect(); ?>