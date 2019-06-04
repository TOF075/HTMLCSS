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

    $requser = $bdd->prepare("SELECT * FROM members WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE members SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
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
            $insertmdp = $bdd->prepare("UPDATE members SET pass = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }
        else
        {

            $msg = "<br><br>Tes deux mots de passe ne correspondent pas !";
        }
    }

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
                $updateAvatar = $bdd->prepare('UPDATE members SET avatar = :avatar WHERE id = :id');
                $updateAvatar->execute(array(
                'avatar' => $_SESSION['id'].".".$extensionUpload,
                'id' => $_SESSION['id']
                ));
                header('location: profil.php?id='.$_SESSION['id']);
            }
        
            else{
                $msg = "Ho! Ho! Il y a eu une erreur durant l'importation de ton avatar";
            }
        }
        else
        {
            $msg = "Ton avatar doit être au format jpg, jpeg, gif ou png";
        }
        }

        else

        {
            $msg="Ton avatar ne doit pas dépasser 2Mo";
        }
    }
    
?>
<html>
<head>
    <title>Edition Profil Etudiant</title>
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