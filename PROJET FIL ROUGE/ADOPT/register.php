<?php 

$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

    echo "Connexion to server ok ! <br><br>";

    $db_name = 'adopte';
    $db = mysqli_select_db($db_handle, $db_name);

// Vérification de la validité des informations

// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// Insertion
$req = $bdd->prepare('INSERT INTO members(pseudo, pass, email, reg_date) VALUES(:pseudo, :pass, :email, CURDATE())');
$req->execute(array(
    'pseudo' => $pseudo,
    'pass' => $pass_hache,
    'email' => $email));


    