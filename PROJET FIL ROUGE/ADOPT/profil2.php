<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=adopte','root','');

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM members WHERE email = ? AND pass = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['email'] = $userinfo['email'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
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
        <title>Page de connexion Business</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
      

   <body>
   <div class="container">
   <h1>Adopte un stage</h1>
            <div class="connexion" id="connexion">
                <p>Profil Employeur</p>

                <br><br>
       

       


         </div>
      </div>
   </body>
</html>