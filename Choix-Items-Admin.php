<?php
session_start();
if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true&&$_SESSION["type_profil"]==2)
{

}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false||$_SESSION["type_profil"]==1)
{
	header('location: connexion_vendeur.php');
}


  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Choix Sur Items - Admin - ECE Amazon</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div>
		<a href="Accueil-Admin.html">
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
		</a>
	</div>
	
	<div>
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(174,174,174);"><a href="Choix-Items-Admin.php" style="color: white">Items</a></div>
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="Choix-Vendeur-Admin.php" style="color: white">Vendeurs</a></div>		
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="vendeur-votrecompte.php" style="color: white">Votre Compte</a></div>
	</div>
	<div>
		<br><br><br><br>
		<div class="col-sm-2" style="background-color: white;"></div>
		<div class="col-sm-4 choicestyle" style="background-color: white;">
			<a href="vendeur-vendre.php">
			<button type="button" class="btn btn-primary btn-lg btn-block">Ajouter un Items</button>
			</a>
		</div>
		<div class="col-sm-4 choicestyle" style="background-color: white;">
			<a href="suppression-items-admin.php">
			<button type="button" class="btn btn-primary btn-lg btn-block">Supprimer un Items</button>
			</a>
		</div>	
		<div class="col-sm-2" style="background-color: white;"></div>
		</div>
</body>
</html>