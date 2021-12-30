<?php

function connect_database(){
    $bdd =  mysqli_connect('localhost', 'root', 'root', 'livreor');
    mysqli_set_charset($bdd, 'utf8');
    return $bdd;
}

function create_user(){
    $bdd = connect_database();
    if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['Cpassword'])) {
        $login= $_POST['login'];
        $password=$_POST['password'];
        $Cpassword = $_POST['Cpassword'];
        $check_user = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login='$login'");
        $count= mysqli_num_rows($check_user);
        if($count == 1){
            echo "Utilisateur déja existant";
        }
        else{
            if($login == NULL || $password == NULL || $Cpassword == NULL ) {
                echo'<p class="erreur">Remplissez tous les champs</p>';
            }
            else if($password != $Cpassword) {
                echo'<p class="erreur">Mot de passe Non identique</p>';
            }
            else{
                $requete = mysqli_query($bdd, "INSERT INTO utilisateurs (login, password, id_droits) VALUES ('$login','$password', 1)");
                header('Location: connexion.php');
                exit();
            }
        }
    }
}

function connect_user() {
    $bdd = connect_database();
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $pw= $_POST['password'];
        if($login != NULL && $pw != NULL) {
            $requete = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login='$login' ");
            $fetch= mysqli_fetch_assoc($requete);
            if(isset($fetch)) {
                $sql_password= $fetch['password'];
                if($pw == $sql_password) {
                    $_SESSION['user'] = $fetch;
                    header('Location: index.php');
                    exit();
                }
                else{
                    echo '<p class="erreur">Mauvais mot de passe</p>';
                }
            }
            else {
                echo'<p class="erreur">Compte inexistant</p>';
            }
        }
        else {
            echo'<p class="erreur">Remplissez tous les champs</p>';
        }
    }
}

function disconnect(){
    if(isset($_POST['deconnexion'])){
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

function change_login(){
    $bdd = connect_database();
    if(!empty($_POST['Nlogin'])){
        $login = $_SESSION['user']['login'];
        $Nlogin = $_POST['Nlogin'];
        $change_login = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login = '$login' ");
        $RowLogin = mysqli_num_rows($change_login);
        if($RowLogin == 1){
            $change_login_test = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login = '$Nlogin' ");
            $RowLoginTest = mysqli_num_rows($change_login_test);
            if($RowLoginTest == 1){
                echo 'Login déjà existant';
            }
            else{
                $new_login = mysqli_query($bdd, "UPDATE utilisateurs SET login = '$Nlogin' WHERE login = '$login'");
                session_destroy();
                header('Location: index.php');
                exit();
            }
        }
        else{
            echo '<p class="erreur">Veuillez vous déconnecter votre Login est inexistant</p>';
        }
    }
}

function change_password(){
    $bdd = connect_database();
    if(!empty($_POST['password']) && !empty($_POST['Npassword']) && !empty($_POST['CNpassword'])){
        $login = $_SESSION['user']['login'];
        $password = $_POST['password'];
        $Npassword = $_POST['Npassword'];
        $CNpassword = $_POST['CNpassword'];
        $change_password = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
        $RowPassword = mysqli_num_rows($change_password);
        if($RowPassword == 1){
            if($Npassword == $CNpassword){
                $new_password = mysqli_query($bdd,"UPDATE utilisateurs SET password = '$Npassword' WHERE login = '$login'");
                session_destroy();
                header('Location: index.php');
                exit();
            }
            else{
                echo '<p class="erreur">Vos nouveau Mot de Passes ne sont pas pareils</p>';
            }
        }
        else{
            echo '<p class="erreur">Votre ancien Mot de Passe est incorrect</p>';
        }
    }
}

function new_com(){
    $bdd = connect_database();
    if(isset($_POST["commentaire"]) && $_POST["commentaire"] != NULL){
        $commentaire = $_POST['commentaire'];
        $id_user = $_SESSION['user']['id'];
        $new_com_request = mysqli_query($bdd, "INSERT INTO commentaires (commentaire, id_utilisateur) VALUES ('$commentaire', '$id_user')");
        header('Location: livre-or.php');
        exit();
    }
}

?>