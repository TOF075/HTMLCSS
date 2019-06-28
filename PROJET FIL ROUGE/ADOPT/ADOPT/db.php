<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'adopte');

function getDB(){

$host=DB_SERVER;
$user=DB_USERNAME;
$pass=DB_PASSWORD;
$dbname=DB_DATABASE;

    try {
        //Connexion Base de données
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        //encodage UTF-8 
        $conn->exec("set names utf8");
        return $conn;
    }
    catch(PDOException $e){
        echo 'Connexion impossible à la base de données : ' . $e->getMessage();
        }
}

// classe pour faire toutes les opérations concernant l'inscription
class inscription {

    public function Student_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2) {
        $bdd = getDB();
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM members WHERE email = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    
                    if($mailexist == 0) {
                        if($mdp == $mdp2) {
                            $insertmbr = $bdd->prepare("INSERT INTO members(first_name, last_name, email, pass, avatar) VALUES (?, ?, ?, ?, ?)");
                            $insertmbr->execute(array($first_name, $last_name, $mail, $mdp, "default.jpg"));
                            $erreur = "Ton compte a bien été créé ! <br> <a href=\"connexion.php\">Me connecter</a>";
                        }else {
                        $erreur = "Tes mots de passe ne correspondent pas !";
                    }} else {
                    $erreur = "Adresse mail déjà utilisée !";
                    }} else {
                    $erreur = "Ton adresse mail n'est pas valide !";
                    }
                } else {
                    $erreur = "Tes adresses mail ne correspondent pas !";
                }
    }

    public function Recruiter_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2) {
        $bdd = getDB();
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM rh WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {
                            if($mdp == $mdp2) {
                            $insertmbr = $bdd->prepare("INSERT INTO rh (last_name, first_name, mail, pass, avatar, company_logo) VALUES(?, ?, ?, ?, ?, ?)");
                            $insertmbr->execute(array("$last_name", "$first_name", "$mail", "$mdp", "default.jpg", "default2.jpg"));
                            $erreur = "Votre compte a bien été créé ! <a href=\"connexion2.php\">Me connecter</a>";
                            }
                            else {
                            $erreur = "Vos mots de passe ne correspondent pas !";
                        }
                    } else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
             $erreur = "Vos adresses mail ne correspondent pas !";
            }
    }

    public function NewCompanyRecruiter_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2, $company_name, $company_siret) {
        $bdd = getDB();
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM rh WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {
                            if($mdp == $mdp2) {

                            $insertComp = $bdd->prepare("INSERT INTO Company (company_name, siret) VALUES('$company_name', $company_siret)");
                            $insertComp->execute();
                            $companyID = $bdd->lastInsertId();

                            $insertmbr = $bdd->prepare("INSERT INTO `rh` (id_company, last_name, first_name, mail, pass, avatar) VALUES($companyID, '$last_name', '$first_name', '$mail', '$mdp', 'default.jpg')");
                            $insertmbr->execute();
                            
                            $erreur = "Votre compte a bien été créé ! <a href=\"connexion2.php\">Me connecter</a>";
                            }
                            else {
                            $erreur = "Vos mots de passe ne correspondent pas !";
                        }
                    } else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
             $erreur = "Vos adresses mail ne correspondent pas !";
            }
    }

}

class connexion {
    public function login($mailconnect, $mdpconnect){
        $bdd = getDB();
        if(!empty($mailconnect) AND !empty($mdpconnect)) {
            $requser = $bdd->prepare("SELECT * FROM members WHERE email = '$mailconnect' AND pass = '$mdpconnect' ");
            $requser->execute();
            $userexist = $requser->rowCount();
            if($userexist == 1) {
               $userinfo = $requser->fetch();
               $_SESSION['id'] = $userinfo['id'];
               $_SESSION['status'] = 'membre';
               $_SESSION['email'] = $userinfo['email'];
               header("Location: profil.php?id=".$_SESSION['id']);
            }else {
               $requser2 = $bdd->prepare("SELECT * FROM rh WHERE mail = '$mailconnect' AND pass = '$mdpconnect'");
               echo "SELECT * FROM rh WHERE mail = '$mailconnect' AND pass = '$mdpconnect'";
               $requser2->execute();
               $userexist2 = $requser2->rowCount();
               if($userexist2 == 1){
                  $userinfo = $requser2->fetch();
                  $_SESSION['id'] = $userinfo['id'];
                  $_SESSION['status'] = 'rh';
                  $_SESSION['email'] = $userinfo['email'];
                  header("Location: profil2.php?id=".$userinfo['id']);
               }else{
                  echo $erreur = "Mauvais mail ou mot de passe !";
               }
            }
         } else {
            echo $erreur = "Tous les champs doivent être complétés !";
         }
    }
}

class members {

    public function getProfileMembers($getid){
        $bdd = getDB();
        $requser = $bdd->prepare('SELECT * FROM members WHERE id = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
        $uid = $userinfo['id'];

        return '<link rel="stylesheet" href="./css/style.css">
        <body>
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="card" style="width:35%">
                    <div class="card-header">
                        <img src="./logoADOPT.png" style="width:15%;"/>
                        <h5 style="display: inline-block;" class="card-title">'. $userinfo['first_name'] .'&nbsp;'.$userinfo['last_name'].'</h5>
                    </div>
                    <img class="card-img-top" src="./members/avatar/'. $userinfo['avatar'] .'" alt="photo de profil">
                    <div class="card-body text-justify">
                    <p class="card-text">'. $userinfo['descript'] .'</p>';
    }

    public function getProfileRH($getid){
        $bdd = getDB();
        $requser = $bdd->prepare('SELECT * FROM `rh`
        INNER JOIN company ON company.id = rh.id_company
        WHERE rh.id = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();

        return '<link rel="stylesheet" href="./css/style.css">
        <body>
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="card" style="width:35%">
                    <div class="card-header">
                        <img src="./logoADOPT.png" style="width:15%;"/>
                        <h5 style="display: inline-block;" class="card-title">'. $userinfo['first_name'] .'&nbsp;'.$userinfo['last_name']. '<br>' . $userinfo['fonction']. '<br>' . $userinfo['company_name'] .' | ' . $userinfo['company_city'].'</h5>
                    </div>
                    <img class="card-img-top" src="./members/avatar/'. $userinfo['avatar'] .'" alt="photo de profil">
                    <div class="card-body text-justify">
                    <p class="card-text">'. $userinfo['descript'] .'</p>';
    }

    public function RhForm($id){
        $bdd = getDB();
        $requser = $bdd->prepare("SELECT * FROM rh WHERE id = ?");
        $requser->execute(array($id));
        $user = $requser->fetch();
    
        if(isset($_POST['newsociete']) AND !empty($_POST['newsociete']) AND $_POST['newsociete'] != $user['societe'])
        {
            $newsociete = htmlspecialchars($_POST['newsociete']);
            $insertsociete = $bdd->prepare("UPDATE rh SET business_name = ? WHERE id = ?");
            $insertsociete->execute(array($newsociete, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);
        }
    
        if(isset($_POST['last_name']) AND !empty($_POST['last_name']) AND $_POST['last_name'] != $user['last_name'])
        {
            $lastname = htmlspecialchars($_POST['last_name']);
            $insertlastname = $bdd->prepare("UPDATE rh SET last_name = ? WHERE id = ?");
            $insertlastname->execute(array($lastname, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);
        }
    
        if(isset($_POST['first_name']) AND !empty($_POST['first_name']) AND $_POST['first_name'] != $user['first_name'])
        {
            $firstname = htmlspecialchars($_POST['first_name']);
            $insertfirstname = $bdd->prepare("UPDATE rh SET first_name = ? WHERE id = ?");
            $insertfirstname->execute(array($firstname, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);
        }
    
        if(isset($_POST['city']) AND !empty($_POST['city']) AND $_POST['city'] != $user['city'])
        {
            $newcity = htmlspecialchars($_POST['city']);
            $insertcity = $bdd->prepare("UPDATE rh SET city = ? WHERE id = ?");
            $insertcity->execute(array($newcity, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);
        }
    
        if(isset($_POST['newfonction']) AND !empty($_POST['newfonction']) AND $_POST['newfonction'] != $user['fonction'])
        {
            $newfonction = htmlspecialchars($_POST['newfonction']);
            $insertfonction = $bdd->prepare("UPDATE rh SET fonction = ? WHERE id = ?");
            $insertfonction->execute(array($newfonction, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);
        }
    
    
        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
        {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);
    
            if($mdp1 == $mdp2)
            {
                $insertmdp = $bdd->prepare("UPDATE rh SET pass = ? WHERE id = ?");
                $insertmdp->execute(array($mdp1, $_SESSION['id']));
                header('location: profil2.php?id='.$_SESSION['id']);
            }
            else
            {
    
                $msg = "<br><br>Vos deux mots de passe ne correspondent pas !";
            }
        }
    
    
        /*-------------------------------------------*/
    
        if(isset($_POST['newdescript'])){
            if(isset($_POST['newdescript']) AND !empty($_POST['newdescript']) AND $_POST['newdescript'] != $user['descript'])
            {
                $newdescript = htmlspecialchars($_POST['newdescript']);
                $insertdescript = $bdd->prepare("UPDATE rh SET descript = ? WHERE id = ?");
                $insertdescript->execute(array($newdescript, $_SESSION['id']));
                header('location: profil2.php?id='.$_SESSION['id']);
            }
        }
    
    /*-------------------------------------------*/
    
    
        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
        {
            $maxSize = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');
    
            // on vérifie la taille de l'image importée
    
            if($_FILES['avatar']['size'] <= $maxSize)
            {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "members/avatar/" .$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateAvatar = $bdd->prepare('UPDATE rh SET avatar = :avatar WHERE id = :id');
                    $updateAvatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                    ));
                    header('location: profil2.php?id='.$_SESSION['id']);
                }
            
                else{
                    $msg = "Ho! Ho! Il y a eu une erreur durant l'importation de votre photo de profil";
                }
            }
            else
            {
                $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            }
            }
    
            else
    
            {
                $msg="Votre photo de profil ne doit pas dépasser 2Mo";
            }
        }
    
        // -----------------------------------------------------------
    
        if(isset($_FILES['company_logo']) AND !empty($_FILES['company_logo']['name']))
        {
            $maxSize = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');
    
            // on vérifie la taille de l'image importée
    
            if($_FILES['company_logo']['size'] <= $maxSize)
            {
            $extensionUpload = strtolower(substr(strrchr($_FILES['company_logo']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "rh/company_logo/" .$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['company_logo']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateCompanylogo = $bdd->prepare('UPDATE rh SET company_logo = :company_logo WHERE id = :id');
                    $updateCompanylogo->execute(array(
                    'company_logo' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                    ));
                    header('location: profil2.php?id='.$_SESSION['id']);
                }
            
                else{
                    $msg = "Ho! Ho! Il y a eu une erreur durant l'importation du logo de votre entreprise";
                }
            }
            else
            {
                $msg = "Le logo de votre entreprise doit être au format jpg, jpeg, gif ou png";
            }
            }
    
            else
    
            {
                $msg="Le logo de votre entreprise ne doit pas dépasser 2Mo";
            }
        }
    }
}


// classe pour faire toutes les operations sur la table Company
class companies {

    public function getCompanies() {
        $bdd = getDB();
        $reqCompanies = $bdd->prepare("SELECT id, company_name, siret FROM company");
        $reqCompanies->execute();
        $count = $reqCompanies->rowCount();

        for($i = 1; $i <= $count; $i++){
            $company = $reqCompanies->fetch(PDO::FETCH_OBJ);
            echo '<option value="SIRET '. $company->siret.' '.$company->company_name. ' "></option>';
        }
    }

    public function getSIRET($companyID) {
        $bdd = getDB();
        $reqSIRET = $bdd->prepare("SELECT siret FROM company WHERE id = ?");
        $reqSIRET->execute(array($companyID));
        $count = $reqSIRET->rowCount();

        for($i = 1; $i <= $count; $i++){
            $company = $reqSIRET->fetch(PDO::FETCH_OBJ);
            return $company->siret;
        }
    }
    public function getCompanyBySIRET($company_siret) {
        $bdd = getDB();
        $reqSIRET = $bdd->prepare("SELECT siret FROM company WHERE siret = ?");
        $reqSIRET->execute(array($company_siret));
        $count = $reqSIRET->rowCount();

        return $count;
    }
}

?>