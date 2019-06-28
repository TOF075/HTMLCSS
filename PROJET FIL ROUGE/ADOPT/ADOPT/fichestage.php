<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/457200879c.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="bienvenue">
                <div align="center">
                    <div class="entete">
                    </div>
                </div>
            
        
<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=adopte', 'root', 'root');

$requser = $bdd->prepare("SELECT * 
FROM `jobcompany`
INNER JOIN job ON jobcompany.id_job = job.id
INNER JOIN company ON jobcompany.id_company = company.id");
$requser->execute(array($_SESSION['id']));
$societe = $requser->fetch();

if(!empty($societe['illustration_job'])) { ?>
    <img src="job/illustration_job/<?php echo $societe['illustration_job']; ?>" width="300" />
<?php } ?>

<?php echo $societe['job_name']; ?><br>
<?php echo $societe['job_sector']; ?>

        <br>
        <br>
        <br>
        <?php echo "<div class=nom>" . "<b>" . $userinfo['first_name']. "</b>" ; ?>
        <?php echo "<b>" . $userinfo['last_name'] . "</b>" . "</div>"; ?>
        
        <?php echo  "<div class=diploma>". $userinfo['diploma'] . "</div>"; ?>
<br>
        <i class="fas fa-map-marker-alt"></i>  <?php echo $userinfo['city']; ?>

        <!-- <label for="story">Je me présente</label><br><br> -->


<div class="container2">
<div class="story" name="story" rows="5" cols="50"><?php echo "<div class=description>" . $userinfo['descript'] . "</div>"; ?> 

</div>
</div>

<br>


<?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
        ?>
        
    <button onclick="location.href='editionprofil.php'" type="button">Editer mon profil</button>
    <button onclick="location.href='disconnect.php'" type="button">Se déconnecter</button>
        <?php
        }
        ?>
</div>
</div>
        </body>
    
</html>