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
	<title>Votre Compte</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<div>

		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	<div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-vendre.php" style="color : white">Vendre un item</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-suppr.html" style = "color : white ">Supprimer un item</a></div>
		<div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
		<div class="col-sm-2 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="vendeur-votrecompte.html" style = "color : white">Votre compte</a></div>
		<br>
	</div>

	<br>
    <div class="col-sm-3"></div>
    <div class="col-sm-6 choicestyle" style="text-align: center;">
        <h2>Votre compte</h2>
        <?php
        echo "<h2>Bienvenu ". $_SESSION["prenom"] . " " . $_SESSION["nom"];
        echo "</h2><br><h2>Votre n°client est : " . $_SESSION["Id_vendeur"] . "</h2>";
        ?>
        <!--AMANDINE AFFICHE LA PHOTO EN DESSOUS-->
    </div>
    <div class="col-sm-3"></div>
</body>
</html>




 