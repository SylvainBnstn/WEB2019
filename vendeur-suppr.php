<?php
session_start();
//recuperer les données venant de la page HTML  
//le parametre de $_POST = "name" de <input> de votre page HTML  
$servername = "localhost";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=eceamazon", $username, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true) {
	$test=$_SESSION["Id_vendeur"];
	$userproduct=$conn->prepare("SELECT * FROM produit WHERE Id_vendeur LIKE '$test'");
	$userproduct2=$conn->prepare("SELECT * FROM produit WHERE Id_vendeur LIKE '$test'");
	$userproduct->execute();
	$userproduct2->execute();
	$nbproduct=$userproduct->rowCount();
	if ($nbproduct > 0) {
		if (isset($nbproduct)) {
			$var2 = $userproduct2->fetchAll(PDO::FETCH_OBJ);
			foreach($var2 as $elem2=>$value2){
				$verif=$value2->Id_produit;
				if(isset($_POST[$verif]))
				{

					echo "coucou";
				}
			}
		}}


		}

if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false){
	header('location: connexion_vendeur.php');
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"> 
	<title>Supprimer des Produits - ECE Amazon</title> 
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">     
		$(document).ready(function(){          
			$('.header').height($(window).height()); 
		});
	</script> 
</head>
<body>
	<!--Logo-->
	<div>

		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	<!--Barre navigation-->
	<div>
		<div>
			<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-vendre.php" style="color : white">Vendre un item</a></div>
			<div class="col-sm-3 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="vendeur-suppr.php" style = "color : white ">Supprimer un item</a></div>
			<div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
			<div class="col-sm-2 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-votrecompte.php" style = "color : white">Votre compte</a></div>
			<br>
		</div>
	</div>

	<div>
		
		<div class="container-fluid">

			<div class="row">	
				<legend class="homestyle">Choisissez le produit que vous voulez supprimer</legend>
			</div>
			<br>
			<div>
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-8">
					<?php
					if (isset($nbproduct)) {
						if ($nbproduct > 0) {

							$var = $userproduct->fetchAll(PDO::FETCH_OBJ);
							echo "<table class='table'>
									<caption>Vos Produits Actuellement en Vente:</caption>
									<tr>
									<th>Image</th>
									<th>Nom</th>
									<th>Prix</th>
									<th>Action</th>
									</tr>";
							
							echo "</tr></thead>";

                        // parcourt de chaque ligne
							$dossier="items/";
							
							$size=100;
							foreach($var as $elem=>$value)
							{
								$loc=$dossier . $value->Photo;
								echo "<tr><td>";
								echo"<img src=".$loc." width='$size' height='$size'/>";
								echo "</td><td>";
								echo $value->Nom;
								echo "</td><td>";
								echo $value->Prix;
								echo "</td><td><a href='vendeur-suppr-items.php?Id=".$value->Id_produit."'><input type='submit' value='Supprimer' name='Supprimer'></a></td>";
								echo "</tr>";
							} 
						}
					}
					?>

				</div>
				<div class="col-sm-2">
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>