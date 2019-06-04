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

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM members WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
   <div class="container">
   <div class="bienvenue">
      <div align="center">
      
         <h2><p>Profil de <?php echo $userinfo['pseudo']; ?></p></h2>


         <br /><br />
         Pseudo = <?php echo $userinfo['pseudo']; ?>
         
         <br />
         Mail = <?php echo $userinfo['email']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="disconnect.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>
   </div>
      </div>
   </body>
</html>
<?php   
}
?>
</html>