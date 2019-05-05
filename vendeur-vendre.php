<?php
session_start();
if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true) {

		if(isset($_POST["livre_bouton"])){
			$_SESSION["type"]=1;
			header('location: vendeur-produit-autre.php');
		}
		if(isset($_POST["sport_loisir_bouton"])){
			$_SESSION["type"]=2;
			header('location: vendeur-produit-autre.php');
		}
		if(isset($_POST["musique_bouton"])){
			$_SESSION["type"]=3;
			header('location: vendeur-produit-autre.php');

}
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
	<title>Vendre - ECE Amazon</title> 
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head> 

<body>

	<div>
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	
	
	<?php
        if ($_SESSION["type_profil"]==1)
		{
			echo "<div><div class='col-sm-3 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='vendeur-vendre.php' style='color : white'>Vendre un item</a></div>";
          echo "<div class='col-sm-3 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='vendeur-suppr.php' style = 'color : white'>Supprimer un item</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> </div>";
            echo "<div class='col-sm-2 toolbarstyle' style='background-color: rgb(174,174,174);'> <a href='vendeur-votrecompte.php' style = 'color : white'>Votre compte</a></div>
        <br><br>
	</div>";
		}
		
	   if ($_SESSION["type_profil"]==2)
		{
			echo "<div><div class='col-sm-4 toolbarstyle' style='background-color: rgb(174,174,174);'> <a href='Choix-Items-Admin.php' style='color : white'>Items</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='Choix-Vendeur-Admin.php' style = 'color : white '>Vendeurs</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='vendeur-votrecompte.php' style = 'color : white'>Votre compte</a></div>
        <br><br>
	</div>"	;
		}		
		?>
	




	<br>
	<h2> Quel type de produit voulez vous vendre ? </h2>
	<br> <br>

	<form class="form-horizontal col-sm-12" method="post" action="" class="needs-validation" class="form-inline">

		<div class="row">
			<div class="col-sm-2" style="background-color: white;"></div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
					<input type="submit" class="btn btn-primary btn-lg btn-block" name="livre_bouton" value="Livres"/>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
					<input type="submit" class="btn btn-primary btn-lg btn-block" name="musique_bouton" value="Musique"/>
			</div>	

			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

		<br>



		<div class="row">

			<div class="col-sm-2" style="background-color: white;"></div>


			<div class="col-sm-4 choicestyle" style="background-color: white;">
					<input type="submit" class="btn btn-primary btn-lg btn-block" name="sport_loisir_bouton" value="Sports et Loisirs"/>
			</div>

			<div class="col-sm-4 choicestyle" style="background-color: white;">
				<a href="vendeur-vendre-vetement.php">
					<input type="button" class="btn btn-primary btn-lg btn-block" name="vetement_bouton" value="Vetement"/>
				</a>
			</div>	
			<div class="col-sm-2" style="background-color: white;"></div>
		</div>

	</form>
	
	

	
	
</body>

</html>
