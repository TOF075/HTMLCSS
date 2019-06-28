<?php
session_start();
include('./db.php');
include('./head.php');

$bdd = getDB();

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

    if(isset($_POST['newcolor']) AND !empty($_POST['newcolor']))
    {
        $newcol = htmlspecialchars($_POST['newcolor']);
        $insertcol = $bdd->prepare("UPDATE members SET color = ? WHERE id = ?");
        $insertcol->execute(array($newcol, $_SESSION['id']));
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









<body style="background-color: #f3f3f3 !important;">
        <div class="container text-align">

        <div style="text-align: center !important;">
            <a href="./index.php"><img class="mb-4" src="./logoADOPT.png" alt="logo"  width="100" height="100"></a>
        </div>
            <div class="col-lg">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                    <div class="form-group col-md-12">
                            <img src="./members/avatar/<?php echo $user['avatar']; ?>" alt="Photo de Profil Inconnue" width="120" height="120"/>
                            <input type="file"name="avatar" class="custom-file-input" id="validatedCustomFile" >
                            <label class="btn btn-default" for="validatedCustomFile">[Importer une photo de Profil]</label>
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="LastNameInput">Nom</label>
                        <input type="text" class="form-control" id="LastNameInput" name="newnom" value="<?php echo $user['last_name']; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="FirstNameInput">Prénom</label>
                        <input type="text" class="form-control" id="FirstNameInput" name="newprenom" value="<?php echo $user['first_name']; ?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="CompanyName">E-Mail</label>
                            <input type="text" class="form-control CompanyNameInput" name="newmail" placeholder="Email" value="<?php echo $user['email']; ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="CompanySiret">Pass</label>
                            <input class="form-control CompanySIRETInput" type="password" name="newmdp1" placeholder="Pass" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="CompanySiret">Confirmation Pass</label>
                            <input class="form-control CompanySIRETInput" type="password" name="newmdp2" placeholder="Confirmation du pass" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ColorStudent">Couleur Dominante Personnalité</label>
                            <select class="form-control CompanyNameInput" name="newcolor" id="colors">
                                <option value="<?php if($user['color'] == null){ echo 'Aucune';}else{ echo $user['color'];} ?>" selected><?php if($user['color'] == null){ echo 'Aucune';}else{ echo $user['color'];} ?></option>
                                <option value="rouge">rouge</option>
                                <option value="vert">vert</option>
                                <option value="bleu">bleu</option>
                                <option value="jaune">jaune</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="StudentBio">Biographie</label>
                            <textarea type="text" class="form-control" name="newdescript"><?php echo $user['descript']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDiploma">Formation</label>
                            <input type="text" class="form-control" name="newdiploma"  placeholder="mon diplome préparé" value="<?php echo $user['diploma']; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputVille">Ville</label>
                            <input type="text" class="form-control" id="inputcity" name="newcity" placeholder="Ville" value="<?php echo $user['city']; ?>"/>
                        </div>
                    </div>
                    <button type="submit" name="forminscription2" class="btn btn-sm  btn-danger submitForm" >Mettre à jour mon profil</button> 
                </form>
            </div>
        </div>
        <?php include('./js/bootstrap.php')?>
    </body>
<?php
if(isset($msg)){
    echo $msg;
}
?>
</html>
<?php   
}
else
{
    header("location: connexion.php");
}
?>
</html>
