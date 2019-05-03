<?php
session_start();
if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true) {

}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false){
	header('location: connexion_vendeur.php');
}

///AMANDINE CODE ICI
?>

<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>Site ECE Amazon</title> 
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head> 

<body>

	<div>
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	<div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="vendeur-vendre.php" style="color : white">Vendre un item</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-suppr.html" style = "color : white ">Supprimer un item</a></div>
		<div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
		<div class="col-sm-2 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-votrecompte.php" style = "color : white">Votre compte</a></div>
		<br>
	</div>
	

	<br>
	<h2> Quel type de produit voulez vous vendre ? </h2>
	<br> <br>

	<form class="form-horizontal col-sm-12" method="post" action="" class="needs-validation" class="form-inline">

		<div class="row">
			<div class="col-sm-2" style="background-color: white;"></div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="vendeur-produit-autre.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="livre_bouton" value="Livres"/>
				</a>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="vendeur-vendre-autre.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="musique_bouton" value="Musique"/>
				</a>
			</div>	

			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

		<br>



		<div class="row">

			<div class="col-sm-2" style="background-color: white;"></div>


			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="vendeur-vendre-autre.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="sport_loisir_bouton" value="Sports et Loisirs"/>
				</a>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="vendeur-vendre-vetement2HTML.php">
					<input type="submit" class="btn btn-primary btn-lg btn-block" name="vetement_bouton" value="Vetement"/>
				</a>
			</div>	
			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

	</form>
	
	

	
	
</body>

</html>
