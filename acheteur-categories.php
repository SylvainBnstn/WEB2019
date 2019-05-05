<?php
session_start();
if (isset($_SESSION["Connected_acheteur"])&&$_SESSION["Connected_acheteur"]==true) {

}
if(!isset($_SESSION["Connected_acheteur"])||$_SESSION["Connected_acheteur"]==false){
	header('location: connexion_acheteur.php');
}

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8"> 
<title>Catégories - ECE Amazon</title> 
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="Style.css" rel="stylesheet" type="text/css"/>
<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>

	<div>

		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	<div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="acheteur-categories.php" style="color : white">Categories</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-ventesflash.php" style = "color : white ">Ventes flash</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
		<div class="col-sm-1 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-panier.php"> <img src="panier1.png" alt="logo" width=45 height="45" /> </a> </div>
		<div class="col-sm-2 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-votrecompte.php" style = "color : white">Votre compte</a></div>
		<br>
	</div>

	<br>
	<h3 style="text-align:center"> Voici les categories </h3>
	<br> <br>

	<form class="form-horizontal col-sm-12" method="post" action="" class="needs-validation" class="form-inline">

		<div class="row">
			<div class="col-sm-2" style="background-color: white;"></div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="acheteur-categorie-livres.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="livre_bouton" value="Livres"/>
				</a>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="acheteur-categorie-musiques.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="musique_bouton" value="Musique"/>
				</a>
			</div>	

			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

		<br>



		<div class="row">

			<div class="col-sm-2" style="background-color: white;"></div>


			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="acheteur-categorie-sports.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="sport_loisir_bouton" value="Sports et Loisirs"/>
				</a>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="acheteur-categorie-vetements.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="vetement_bouton" value="Vetement"/>
				</a>
			</div>	
			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

	</form>
</body>

</html>