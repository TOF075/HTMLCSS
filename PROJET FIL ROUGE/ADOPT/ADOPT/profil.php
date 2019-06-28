<!DOCTYPE html>
<?php
session_start();
include('./db.php');
include('./head.php');

$su = new members();

if(isset($_GET['id']) AND $_GET['id'] > 0) {
	$getid = intval($_GET['id']);
	echo $su->getProfileMembers($getid);
	if(isset($_SESSION['id']) AND $_GET['id'] == $_SESSION['id']) {
?>
		<div class="text-center">
			<button class="btn text-white" style="background-color: orange !important" onclick="location.href='editionprofil.php'" type="button">Editer mon profil</button>
			&nbsp;
			<button class="btn text-white" style="background-color: orange !important" onclick="location.href='disconnect.php'" type="button">Se déconnecter</button>
			<div>
				</div>
					</div>
				</div>
			</div>
		</body>
<?php
		 }
}
include('./js/bootstrap.php');
?>
</html>