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
if (isset($_SESSION["Connected_acheteur"])&&$_SESSION["Connected_acheteur"]==true) {

	$type_product=1;
	$id_product=$_GET['Id'];
	$buyproduct=$conn->prepare("SELECT * FROM produit WHERE Id_produit = $id_product");
	$buyproduct->execute();
	$nbproduct=$buyproduct->rowCount();
	if (isset($_POST['Ajouter_panier'])) {
		$id_acheteur=$_SESSION["Id_client"];
		$id_prod=$_SESSION["id_prod"];
		$transac=0;
		$requete = $conn->prepare("INSERT INTO panier (Id_produit, Id_acheteur, Etat_transac) VALUES('$id_prod','$id_acheteur','$transac')");
		$requete->execute([$id_prod,$id_acheteur,$transac]);
		header('location: acheteur-panier.php');
	}
	

}
if(!isset($_SESSION["Connected_acheteur"])||$_SESSION["Connected_acheteur"]==false){
	header('location: Connexion.php');
}

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8"> 
<title>Produit - ECE Amazon</title> 
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="Style.css" rel="stylesheet" type="text/css"/>
<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
	<div>
		<br><br><br><br>
		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<?php
			if (isset($nbproduct)) {
				if ($nbproduct > 0) {

					$var = $buyproduct->fetchAll(PDO::FETCH_OBJ);
					$dossier="items/";
					$size=350;
					foreach($var as $elem=>$value)
					{
						$loc=$dossier . $value->Photo;
						echo "<div class='col-sm-3'></div><div class='col-sm-4'>";
						echo"<img src=".$loc." width='$size' height='$size'/></div>";
						echo "<div class='col-sm-4'><br><br><h3>";
						echo $value->Nom;
						echo "</h3><h4>";
						echo $value->Description;
						echo "</h4><br><h3>";
						echo $value->Prix;
						echo "€</h3><h4>Stock Disponible: ";
						echo $value->Stock;
						if (($value->Couleur!=" ")&&($value->Couleur!="")) {
							echo "<br> Couleur: ";
							echo $value->Couleur;
						}
						if (($value->Taille!=" ")&&($value->Taille!="")) {
							echo "<br> Taille: ";
							echo $value->Taille;
						}
						echo "</h4>";
						$video= $value->Video;
						if (($video!=" ")&&($video!="")) {
							echo "<br>Aperçu:<br><div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src=".$video."></iframe></div>";
						}
						$method="post";
						echo "<br><br><form action='' method='$method'><input class='btn btn-primary btn-lg' type='submit' value='Ajouter au panier' name='Ajouter_panier'></form>";
						echo "</div>";
						$_SESSION["id_prod"]=$value->Id_produit;
						$_SESSION["stock"]=$value->Stock;
					}
				}
			}
			
			?>

		</div>
		<div class="col-sm-2">

		</div>

	</div>
</body>
</html>