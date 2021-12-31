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
                echo '<p class="erreur">Vos nouveau mots de passe ne correspondent pas</p>';
            }
        }
        else{
            echo '<p class="erreur">Votre ancien mots de passe est incorrect</p>';
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

function display_com(){
    $bdd = connect_database();
    $request_com = mysqli_query($bdd, "SELECT * FROM commentaires");
    $fetch = mysqli_fetch_all($request_com, MYSQLI_ASSOC);
    foreach($fetch AS $com){
        ?>  <div class="all_com">
                <div class="com_left">
                    <?php
                        $id_utilisateur = $com['id_utilisateur'];
                        $request_user = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id ='$id_utilisateur'");
                        $fetch2 = mysqli_fetch_all($request_user, MYSQLI_ASSOC);
                        foreach($fetch2 AS $us){
                            if($us['id'] == $id_utilisateur){
                                echo 'Commentaire écrit par : '.$us['login'].'</br> le '.$com['date'];
                                break;
                            }
                        }
                    ?>
                </div>
        <?php
        ?>      <div class="com_right">
                    <?php echo $com['commentaire'];?>
                </div>
            </div>
<?php
    }
}

function display_all_users(){
    $bdd = connect_database();
    $request_all_user = mysqli_query($bdd, 'SELECT * FROM utilisateurs');
    $fetch_users = mysqli_fetch_all($request_all_user, MYSQLI_ASSOC);
    ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Login</th>
                </tr>
            </thead>
            <tbody>
    <?php
    foreach($fetch_users AS $fu){
        echo '<tr><td>'.$fu['id'].'</td>';
        echo '<td>'.$fu['login'].'</td></tr>';
    }
    ?>
            </tbody>
        </table>
    <?php
}

function delete_user(){
    $bdd = connect_database();
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if($id != NULL){
            $request_id = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = '$id'");
            $row_id = mysqli_num_rows($request_id);
            if($row_id == 1){
                if($id != $_SESSION['user']['id']){
                    $delete_user = mysqli_query($bdd, "DELETE FROM utilisateurs WHERE id = '$id'");
                    $delete_com = mysqli_query($bdd, "DELETE FROM commentaires WHERE id_utilisateur = '$id'");
                    header('Location: admin.php');
                    exit();
                }
                else{
                    echo '<p class="erreur">Vous ne pouvez pas supprimer votre compte ici</p>
                        <p class="erreur">Allez dans <a href="profil.php" class="profilFun" >profil<a> si vous voulez vraiment supprimer votre compte</p>';
                }
            }
            else{
                echo '<p class="erreur">Cet utilisateur est inexistant</p>';
            }
        }
        else{
            echo '<p class="erreur">Veuillez entrer un ID</p>';
        }
    }
}

function delete_account(){
    $bdd = connect_database();
    if(isset($_POST['delete'])){
        $id = $_SESSION['user']['id'];
        $delete_account = mysqli_query($bdd, "DELETE FROM utilisateurs WHERE id = '$id'");
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

function isConnected(){
    if(!isset($_SESSION['user']['login'])){
        header('Location: index.php');
        exit();
    }
}

function isntConnected(){
    if(isset($_SESSION['user']['login'])){
        header('Location: profil.php');
        exit();
    }
}

function go_to_com(){
    if(isset($_POST['go_to_com'])){
        header('Location: mes_commentaires.php');
        exit();
    }
}

function show_com(){
    $bdd = connect_database();
    $id_user = $_SESSION['user']['id'];
    $request_my_com = mysqli_query($bdd, "SELECT * FROM commentaires WHERE id_utilisateur = '$id_user'");
    $fetch_coms = mysqli_fetch_all($request_my_com, MYSQLI_ASSOC);
    $Rows_num_com = mysqli_num_rows($request_my_com);
    if($Rows_num_com != 0){
        ?>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Commentaires</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        foreach($fetch_coms AS $fc){
            echo '<tr><td>'.$fc['id'].'</td>';
            echo '<td>'.$fc['commentaire'].'</td></tr>';
        }
        ?>
                </tbody>
            </table>
        <?php
    }
    else{
        echo "<p class='text_change2'>Vous n'avez écrit aucun commentaire.</p>";
    }
}

function delete_com(){
    $bdd = connect_database();
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if($id != NULL){
            $id_user = $_SESSION['user']['id'];
            $request_id = mysqli_query($bdd, "SELECT * FROM commentaires WHERE id = '$id' AND id_utilisateur = '$id_user'");
            $row_id = mysqli_num_rows($request_id);
            if($row_id == 1){
                $delete_user = mysqli_query($bdd, "DELETE FROM commentaires WHERE id = '$id' AND id_utilisateur = '$id_user'");
                header('Location: mes_commentaires.php');
                exit();
            }
            else{
                echo '<p class="erreur">Ce commentaire est inexistant</p>';
            }
        }
        else{
            echo '<p class="erreur">Veuillez entrer un ID</p>';
        }
    }
}
?>