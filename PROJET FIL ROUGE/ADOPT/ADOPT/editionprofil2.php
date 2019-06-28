<?php
session_start();
include('./db.php');
include('./head.php');

$bdd = getDB();

if(isset($_SESSION['id'])) {

    $requser = $bdd->prepare("SELECT rh.id, avatar, last_name, first_name, company_name, company_logo, company_city, fonction, siret, rh.mail, descript  FROM rh INNER JOIN Company ON rh.id_company = company.id WHERE rh.id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    $newsociety = new companies();


    if(isset($_POST['newsociete']) && !empty($_POST['newsociete']) && $_POST['newsociete'] != $user['company_name'] 
    && isset($_POST['newSIRET']) && !empty($_POST['newSIRET']) && $_POST['newSIRET'] != $user['siret'] )
    {
        $newSIRET = htmlspecialchars($_POST['newSIRET']);
        $newsociete = htmlspecialchars($_POST['newsociete']);
        $newIdsociete = $bdd->prepare("SELECT id FROM company WHERE siret = ? && company_name = ?");
        $newIdsociete->execute(array($newSIRET, $newsociete));
        $count = $newIdsociete->rowCount();
        if($count === 1 ){
            $company = $newIdsociete->fetch();
            $known = $company['id'];
            $insertsociete = $bdd->prepare("UPDATE rh SET id_company = ? WHERE id = ?");
            $insertsociete->execute(array($known, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);

        }
        else{

            //INSERT dans company

            $insertsociete = $bdd->prepare("INSERT INTO company(company_name, siret) VALUES(?,?)");
            $insertsociete->execute(array($newsociete, $newSIRET));
            $idNewcompany =  $bdd->lastInsertId();

            // Update dans rh

            
            
            $update = $bdd->prepare("UPDATE rh SET id_company = ? WHERE id = ?");
            $insertsociete->execute(array($idNewcompany, $_SESSION['id']));
            header('location: profil2.php?id='.$_SESSION['id']);

        }



        // $insertsociete = $bdd->prepare("UPDATE rh SET business_name = ? WHERE id = ?");
        // $insertsociete->execute(array($newsociete, $_SESSION['id']));
        // header('location: profil2.php?id='.$_SESSION['id']);
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
        $city = htmlspecialchars($_POST['city']);
        $insertcity = $bdd->prepare("UPDATE company INNER JOIN rh on rh.id_company = company.id SET company_city = ? WHERE id = ?");
        $insertcity->execute(array($city, $_SESSION['id']));
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
            $chemin = "./members/avatar/" .$_SESSION['id'].".".$extensionUpload;
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
            $chemin = "./rh/company_logo/" .$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['company_logo']['tmp_name'], $chemin);
            if($resultat)
            {

                $updateCompanylogo = $bdd->prepare("UPDATE company INNER JOIN rh ON rh.id_company = company.id SET company_logo = :company_logo WHERE rh.id = :id ");
                $updateCompanylogo->execute(array(
                'company_logo' => $chemin,
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

    
    // ------------------------------------------------
?>

    <title>Edition Profil Employeur/RH</title>
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
                        <input type="text" class="form-control" id="LastNameInput" name="last_name" value="<?php echo $user['last_name']; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="FirstNameInput">Prénom</label>
                        <input type="text" class="form-control" id="FirstNameInput" name="first_name" value="<?php echo $user['first_name']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="CompanyName">E-Mail</label>
                            <input type="text" class="form-control CompanyNameInput"  name="newmail" placeholder="Email" value="<?php echo $user['mail']; ?>" />
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
                        
                        <div class="form-group col-md-12">
                            <label for="CompanyName">Biographie</label>
                            <textarea type="text" class="form-control" id="CompanyName" name="newdescript"><?php echo $user['descript']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <img src="<?php echo $user['company_logo']; ?>" alt="logo societe"/>
                    </div>
                        <div class="custom-file form-group col-md-6">
                            <input type="file" name="company_logo" class="custom-file-input" id="validated" >
                            <label class="btn btn-default" for="validated">[Choisir un fichier]</label>
                        </div>
                    </div>
                    <div class="form-row">

                    
                    <div class="form-group col-md-3">
                            <label for="inputPass">Société</label>
                            <input type="text" class="form-control inputNomSociete" list="nomDeSociete" name="newsociete" placeholder="Entrez le nom de votre société"  value="<?php echo $user['company_name']; ?>" />
                            <datalist id='nomDeSociete'>
                            
                            <?php 
                        
                            $newsociety->getCompanies();
                            
                            ?>
                            </datalist>
                        </div>



                        <div class="form-group col-md-3">
                            <label for="inputPass">SIRET</label>
                            <input type="text" class="form-control inputSIRET" name="newSIRET" placeholder="Entrez votre numéro SIRET"  value="<?php echo $user['siret']; ?>" />
                            
                         
                        </div>
                        <div class="form-group col-md-3">
                            <label for="CompanyName">Ville</label>
                            <input type="text" class="form-control CompanyNameInput"  name="city" placeholder="ex : Metz" value="<?php echo $user['company_city']; ?>" />
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label for="inputPass2">Fonction</label>
                            <input type="text" class="form-control" id="inputPass2" name="newfonction" placeholder="Définissez votre fonction" value="<?php echo $user['fonction']; ?>"/>
                        </div>
                    </div>
                    <button type="submit" name="forminscription2" class="btn btn-sm  btn-danger submitForm" >Mettre à jour mon profil</button> 
                    <button class="btn btn-sm btn-default" style="background-color: orange !important" onclick="location.href='fichestage.php'" type="button">Je crée une fiche Stage</button>
                    <button class="btn btn-sm btn-default" style="background-color: #ffff !important" onclick="location.href='profil2.php?id=<?php echo $_SESSION['id'];?>'" type="button">Retour en arrière</button>
                </form>
            </div>
        </div>
        <?php include('./js/bootstrap.php')?>
    <script src="./js/script.js"></script>
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
    header("location: connexion2.php");
}
?>
</html>