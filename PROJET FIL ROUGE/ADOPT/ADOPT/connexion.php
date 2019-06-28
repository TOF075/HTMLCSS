<?php
session_start();
include('./db.php');
include('./head.php');
$su = new connexion();

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   $su->login($mailconnect, $mdpconnect);

   if(isset($erreur)) {
      echo '<p style="color: red;">'.$erreur."</p>";
   }
}
?>

<link rel="stylesheet" href="./css/style.css">
<body class="text-center">
   <div class="container">
      <form class="form-signin" method="POST" action="">
         <img class="mb-4" src="./logoADOPT.png" alt="logo" width="150" height="150">

         <label for="mailconnect" class="sr-only">Adresse mail</label>
         <input type="email" class="form-control" name="mailconnect" placeholder="Mail" />

         <label for="mdpconnect" class="sr-only">Mot de Passe</label>
         <input type="password" class="form-control" name="mdpconnect" placeholder="Mot de passe" />
         <button type="submit" class="btn btn-lg text-white" name="formconnexion" value="Se connecter !" style="background-color: orange !important">Se Connecter</button>
         <p class="mt-5 mb-3 text-muted">© 2019</p>
      </form>
   </div>
   <?php include("./js/bootstrap.php"); ?> 
</body>
</html>