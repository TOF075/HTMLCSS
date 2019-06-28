<?php 
include('./head.php');
include('./db.php');

$su = new inscription();
$comp = new companies();

if(isset($_POST['forminscription']) || isset($_POST['forminscription2'])) {

    $last_name = htmlspecialchars($_POST['last_name']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if(isset($_POST['CompanyName'])){ $company_name = htmlspecialchars($_POST['CompanyName']); }
    if(isset($_POST['CompanySIRET'])){ $company_siret = htmlspecialchars($_POST['CompanySIRET']); }

    if(isset($last_name) && isset($first_name) && isset($mail) && isset($mail2) && isset($mdp) && isset($mdp2) && isset($company_name) && $company_name !== '' && isset($company_siret) && $company_siret !== '') {
        $CompanyExist = $comp->getCompanyBySIRET($company_siret);
        if($CompanyExist === 1){
            $su->Recruiter_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2);
        }else{
            $su->NewCompanyRecruiter_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2, $company_name, $company_siret);
        }
    } else if(isset($last_name) && isset($first_name) && isset($mail) && isset($mail2) && isset($mdp) && isset($mdp2)) {
        echo "hello";
        $su->Student_SignUp($last_name, $first_name, $mail, $mail2, $mdp, $mdp2);
    } else {
        $erreur = "Tous les champs doivent être complétés !";
     }
}


?>
    <body style="background-color: #f3f3f3 !important ">
        <div class="container text-align">

        <div style="text-align: center !important;">
            <a href="./index.php"><img class="mb-4" src="./logoADOPT.png" alt="logo"  width="100" height="100"></a>
        </div>
            <div class="col-lg">
                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="LastNameInput">Nom</label>
                        <input type="text" class="form-control" id="LastNameInput" name="last_name" placeholder="Ton Nom" required />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="FirstNameInput">Prénom</label>
                        <input type="text" class="form-control" id="FirstNameInput" name="first_name" placeholder="Ton Prénom" required />
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">E-Mail</label>
                        <input type="mail" class="form-control" id="inputEmail" name="mail" placeholder="E-Mail" required />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail2">Confirmation E-Mail</label>
                        <input type="mail" class="form-control" id="inputEmail2" name="mail2" placeholder="Confirmation E-Mail" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPass">Mot de Passe</label>
                            <input type="password" class="form-control" id="inputPass" name="mdp" placeholder="******" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Veuillez entrer au moins 6 caractères' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPass2">Confirmation Mot de Passe</label>
                            <input type="password" class="form-control" id="inputPass2" name="mdp2" placeholder="******" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Veuillez faire correspondre les deux mot de passes' : '');" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" class="form-control selectStatus">
                            <option selected>Choisir</option>
                            <option>Étudiant</option>
                            <option>Sans emploi</option>
                            <option>Recherche d'emploi</option>
                            <option>Société</option>
                            <option>Ressources Humaines</option>
                        </select>
                        </div>
                    </div>
                <button type="submit" name="forminscription" class="btn btn-sm btn-warning submitForm1" style="background-color: orange !important" disabled>S'inscrire</button>
                <a href="./index.php" class="btn btn-sm btn-danger already1" >Dejà Inscrit ?</a>
            </div>
            <div class="col-lg companyForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="CompanyName">Entreprise</label>
                            <input type="text" class="form-control CompanyNameInput" id="CompanyName" name="CompanyName" list="companies" placeholder="ex: Entreprise S.A" />
                            <datalist id="companies"><?php $comp->getCompanies(); ?></datalist>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="CompanySiret">SIRET</label>
                            <input type="text" class="form-control CompanySIRETInput" id="CompanySiret" name="CompanySIRET" placeholder="ex: 732 829 320 00074" />
                        </div>
                    </div>
                    <button type="submit" name="forminscription2" class="btn btn-sm  btn-warning submitForm" style="background-color: orange !important">S'inscrire</button> 
                    <a href="./index.php" class="btn btn-sm btn-danger" >Dejà Inscrit ?</a>
                </form>
            </div>
        </div>
        <?php include('./js/bootstrap.php')?>
        <script src="./js/form.js"></script>
    </body>
<?php
if(isset($erreur)) {
    echo '<font color="red">'.$erreur.'</font>';
}
?>             
            
</html>

