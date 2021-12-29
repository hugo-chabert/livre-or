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
                echo'<p>Remplissez tous les champs</p><style>p{color : var(--RedError-); font-size: 1.4em;}</style>';
            }
            else if($password != $Cpassword) {
                echo'<p>Mot de passe Non identique</p><style>p{color : var(--RedError-); font-size: 1.4em;}</style>';
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
                    echo 'Mauvais mot de passe';
                }
            }
            else {
                echo'<p>Compte inexistant</p><style>p{color : var(--RedError-); font-size: 1.4em;}</style>';
            }
        }
        else {
            echo'<p>Remplissez tous les champs</p><style>p{color : var(--RedError-); font-size: 1.4em;}</style>';
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

?>