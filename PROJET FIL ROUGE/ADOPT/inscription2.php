<?php

$bdd = new PDO('mysql:host=localhost;dbname=adopte','root','');

if(isset($_POST['forminscription']))
{
$business_name = htmlspecialchars($_POST['societe']);
$last_name = htmlspecialchars($_POST['last_name']);
$first_name = htmlspecialchars($_POST['first_name']);
$mail = htmlspecialchars($_POST['mail']);
$mail2 = htmlspecialchars($_POST['mail2']);
$mdp = sha1($_POST['mdp']);
$mdp2 = sha1($_POST['mdp2']);
if(!empty($_POST['societe']) AND !empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
    $pseudolength = strlen($business_name);
    if($pseudolength <= 255) {
    if($mail == $mail2) {
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $reqmail = $bdd->prepare("SELECT * FROM rh WHERE mail = ?");
            $reqmail->execute(array($mail));
            $mailexist = $reqmail->rowCount();
            if($mailexist == 0) {
                if($mdp == $mdp2) {
                $insertmbr = $bdd->prepare("INSERT INTO rh(business_name, last_name, first_name, mail, pass) VALUES(?, ?, ?, ?, ?)");
                $insertmbr->execute(array($business_name, $last_name, $first_name, $mail, $mdp));
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
   } else {
      $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
   }
} else {
   $erreur = "Tous les champs doivent être complétés !";
}
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adopte un stage</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Adopte un stage</h1>
            <div class="inscription" id="inscription">
                <p>Page d'inscription des Employeurs</p>
                <br><br>
            
                <form method="POST" action="">
                    <table>
                    <tr>
                        <td align="right">
                            <label for="societe">Société :</label>
                        </td>
                        <td>
                            <input type="text" placeholder="Le nom de votre société" id="societe" name="societe" value="<?php if(isset($societe)) { echo $societe; } ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="last_name">Nom :</label>
                        </td>
                        <td>
                            <input type="text" placeholder="Votre nom" id="last_name" name="last_name" value="<?php if(isset($last_name)) { echo $last_name; } ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="first_name">Prénom :</label>
                        </td>
                        <td>
                            <input type="text" placeholder="Votre prénom" id="first_name" name="first_name" value="<?php if(isset($first_name)) { echo $first_name; } ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail">Mail :</label>
                        </td>
                        <td>
                            <input type="mail" placeholder="Votre email" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail2">Confirmation du mail :</label>
                        </td>
                        <td>
                            <input type="email" placeholder="Confirmez votre email" id="mail2" name="mail2"value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mdp">Pass :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Votre pass" id="mdp" name="mdp"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mdp2">Confirmation du pass :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Confirmez votre pass" id="mdp2" name="mdp2"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                          <br>
                            <input type="submit" name="forminscription" value="Je m'inscris"/>
                        </td>
                        
                    </tr>
                  </table>
                </form>
                <?php
        if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
        }
        ?>
            </div>
        </div>
    </body>
</html>