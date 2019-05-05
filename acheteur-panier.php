<?php
session_start();

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

if (isset($_SESSION["Connected_acheteur"])&&$_SESSION["Connected_acheteur"]==true&&(isset($_SESSION["Default_user"])&&$_SESSION["Default_user"]==true)) {
	
	$id_client=$_SESSION["Id_client"];
	$panierproduct=$conn->prepare("SELECT * FROM panier WHERE Id_acheteur LIKE $id_client AND Etat_transac=0");
	$panierproduct->execute();
	$nbproduct=$panierproduct->rowCount();
	if (isset($_POST['acheter_panier'])) {
		unset($_SESSION["Panier"]);
		header('location: compte_acheteur.php');
	}
}

if (isset($_SESSION["Connected_acheteur"])&&$_SESSION["Connected_acheteur"]==true&&(!isset($_SESSION["Default_user"])||$_SESSION["Default_user"]==false)) {

	$id_client=$_SESSION["Id_client"];
	$panierproduct=$conn->prepare("SELECT * FROM panier WHERE Id_acheteur LIKE $id_client AND Etat_transac=0");
	$panierproduct->execute();
	$nbproduct=$panierproduct->rowCount();

	if (isset($_POST['acheter_panier'])&&$_SESSION["Default_user"]==false) {
		for ($i = 0 ; $i < count($_SESSION["Panier"]) ; $i++) {
			$idprodtemp=$_SESSION["Panier"][$i];
			$requete = $conn->prepare("UPDATE produit SET Stock = Stock-1 WHERE Id_produit = $idprodtemp ");
			$requete->execute();
			$requete2 = $conn->prepare("UPDATE panier SET Etat_transac = 1 WHERE Id_produit = $idprodtemp");
			$requete2->execute();
		}
		unset($_SESSION["Panier"]);
		header('location: acheteur-votrecompte.php');
		mail("haseceamazon@gmail.com", "un sujet","Merci pour votre achat effectué sur ECEAmazon. Nous vous confirmons la préparation de votre commande. A bientot!","Commande ECEAmazon");
	}
}
if(!isset($_SESSION["Connected_acheteur"])||$_SESSION["Connected_acheteur"]==false){
	header('location: Connexion.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Votre Panier - ECE Amazon</title>
</head>
<body>
	<div>

		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>
	<div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-categories.php" style="color : white">Categories</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-ventesflash.php" style = "color : white ">Ventes flash</a></div>
		<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
		<div class="col-sm-1 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="acheteur-panier.php"> <img src="panier1.png" alt="logo" width=45 height="45" /> </a> </div>
		<div class="col-sm-2 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-votrecompte.php" style = "color : white">Votre compte</a></div>
		<br>
	</div>

	<br>
	<h3 style="text-align: center"> Mon panier </h3>
	<br>
	<div>
		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<div>
				<?php
				if (isset($nbproduct)) {
					if ($nbproduct > 0) {
						unset($_SESSION["Panier"]);
						$var = $panierproduct->fetchAll(PDO::FETCH_OBJ);
						echo "<table class='table'>
						<caption>Votre Panier :</caption>
						<tr>
						<th>Image</th>
						<th>Nom</th>
						<th>Prix</th>
						<th>Stock</th>
						<th>Action</th>
						</tr>";

						echo "</tr></thead>";

                        // parcourt de chaque ligne
						$dossier="items/";
						$method="post";
						$size=100;

						foreach($var as $elem=>$value)
						{
							$temp= $value->Id_produit;
							$affichproduct=$conn->prepare("SELECT * FROM produit WHERE Id_produit = $temp ");
							$affichproduct->execute();
							$nbpanier=$affichproduct->rowCount();
							$var2 = $affichproduct->fetchAll(PDO::FETCH_OBJ);
							$achat=$value->Id_achat;
							foreach($var2 as $elem=>$value2)
							{
								
								$loc=$dossier . $value2->Photo;
								echo "<tr><td>";
								echo"<img src=".$loc." width='$size' height='$size'/>";
								echo "</td><td>";
								echo $value2->Nom;
								echo "</td><td>";
								echo $value2->Prix;
								echo "€</td><td>";
								echo $value2->Stock;
								echo "</td><td><a href='page-suppr-produit.php?Id=".$value2->Id_produit."&Ida=".$achat."'><input type='submit' value='Supprimer du Panier'></a></td>";
								echo "</tr>";
								
							}
							$_SESSION["Panier"][]=$value->Id_produit;
							$_SESSION["Suppr_item"]=$temp;
						}
						
					}
				}
				?>

			</div>

		</div>			

		<div class="col-sm-2">
			<form action='' method='post'>
			<input type='submit' value='Valider la commande' class='btn btn-primary btn-lg' name='acheter_panier'>
		</form>
		</div>


	</div>

</div>
<div>
	
</div>

</body>
</html>