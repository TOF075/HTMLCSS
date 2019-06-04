<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="style.css">

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=adopte', 'root', '');

if(isset($_SESSION['id'])) {

    $requser = $bdd->prepare("SELECT * FROM rh WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newsociete']) AND !empty($_POST['newsociete']) AND $_POST['newsociete'] != $user['societe'])
    {
        $newsociete = htmlspecialchars($_POST['newsociete']);
        $insertsociete = $bdd->prepare("UPDATE rh SET business_name = ? WHERE id = ?");
        $insertsociete->execute(array($newsociete, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE members SET email = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);

        if($mdp1 == $mdp2)
        {
            $insertmdp = $bdd->prepare("UPDATE rh SET pass = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }
        else
        {

            $msg = "<br><br>Vos deux mots de passe ne correspondent pas !";
        }
    }

    if(isset($_FILES['picture_rh']) AND !empty($_FILES['picture_rh']['name']))
    {
        $maxSize = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');

        // on vérifie la taille de l'image importée

        if($_FILES['picture_rh']['size'] <= $maxSize)
        {
        $extensionUpload = strtolower(substr(strrchr($_FILES['picture_rh']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides))
        {
            $chemin = "rh/picture_rh/" .$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['picture_rh']['tmp_name'], $chemin);
            if($resultat)
            {
                $updateAvatar = $bdd->prepare('UPDATE rh SET picture_rh = :picture_rh WHERE id = :id');
                $updateAvatar->execute(array(
                'picture_rh' => $_SESSION['id'].".".$extensionUpload,
                'id' => $_SESSION['id']
                ));
                header('location: profil.php?id='.$_SESSION['id']);
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
    
?>
<html>
<head>
    <title>Edition Profil Employeur/RH</title>
    <meta charset="utf-8">
</head>
<body>
<div class="container">
<div class="bienvenue">
    <div align="center">

        <h2><p>Edition de mon profil</p></h2><br><br>
        
            <form method="POST" action="" enctype="multipart/form-data">
            
                <label>Pseudo :</label>
                <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br><br>




<label>Mail :</label>
                <input type="text" name="newmail" placeholder="Email" value="<?php echo $user['email']; ?>" /><br><br>





<label>Pass :</label>
                <input type="password" name="newmdp1" placeholder="Pass"/><br><br>


                <label>Confirmation du pass :</label>
                <input type="password" name="newmdp2" placeholder="Confirmation du pass"/><br><br>
                <label>Avatar :</label>
                <input type="file" name="avatar"><br><br><br><br>
                <input type="submit" value="Mettre mon profil à jour"/>
               
            </form>

            <?php
            if(isset($msg)){
                echo $msg;
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>
<?php   
}

else
{
    header("location: connexion.php");
}
?>
</html>