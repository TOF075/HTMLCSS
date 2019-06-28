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

    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE members SET first_name = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE members SET last_name = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newdiploma']) AND !empty($_POST['newdiploma']) AND $_POST['newdiploma'] != $user['diploma'])
    {
        $newdiploma = htmlspecialchars($_POST['newdiploma']);
        $insertdiploma = $bdd->prepare("UPDATE members SET diploma = ? WHERE id = ?");
        $insertdiploma->execute(array($newdiploma, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newcity']) AND !empty($_POST['newcity']) AND $_POST['newcity'] != $user['city'])
    {
        $newcity = htmlspecialchars($_POST['newcity']);
        $insertcity = $bdd->prepare("UPDATE members SET city = ? WHERE id = ?");
        $insertcity->execute(array($newcity, $_SESSION['id']));
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


/*-------------------------------------------*/
if(isset($_POST['newdescript'])){
    if(isset($_POST['newdescript']) AND !empty($_POST['newdescript']) AND $_POST['newdescript'] != $user['descript'])
    {
        $newdescript = htmlspecialchars($_POST['newdescript']);
        $insertdescript = $bdd->prepare("UPDATE members SET descript = ? WHERE id = ?");
        $insertdescript->execute(array($newdescript, $_SESSION['id']));
        header('location: profil.php?id='.$_SESSION['id']);
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
/*-------------------------------------------*/



    
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

        <h2><p>Edition de mon profil</p></h2>
        
            <form method="POST" action="" enctype="multipart/form-data">
            
                <label>Pseudo </label>
                <input type="text" name="newpseudo" placeholder="pseudo" value="<?php echo $user['pseudo']; ?>" /><br><br>

                <label>Prénom </label>
                <input type="text" name="newprenom" placeholder="prénom" value="<?php echo $user['first_name']; ?>" /><br><br>

                <label>Nom </label>
                <input type="text" name="newnom" placeholder="nom" value="<?php echo $user['last_name']; ?>" /><br><br>

                <label>Mail </label>
                <input type="text" name="newmail" placeholder="email" value="<?php echo $user['email']; ?>" /><br><br>

                <label>Pass </label>
                <input type="password" name="newmdp1" placeholder="pass"/><br><br>

                <label>Confirmation du pass </label>
                <input type="password" name="newmdp2" placeholder="confirmation du pass"/><br><br>
                <label>Avatar </label>
                <input type="file" name="avatar"><br><br>

                <label>Diplôme préparé </label>
                <input type="text" name="newdiploma" placeholder="ma formation" value="<?php echo $user['diploma']; ?>" /><br><br>

                <label>Ma ville </label>
                <input type="text" name="newcity" placeholder="ma ville" value="<?php echo $user['city']; ?>" /><br><br>

                <label><h2>Ma biographie</h2> </label><br><br>
                <textarea name="newdescript" value="ma biographie" rows="5" cols="50"/><?php echo $user['descript']; ?></textarea>

<br>
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