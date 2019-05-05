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
	$type_product=3;
	$buyproduct=$conn->prepare("SELECT * FROM produit WHERE Type LIKE $type_product AND Stock > 0");
	$buyproduct->execute();
	$nbproduct=$buyproduct->rowCount();
}
if(!isset($_SESSION["Connected_acheteur"])||$_SESSION["Connected_acheteur"]==false){
	header('location: Connexion.php');
}

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8"> 
<title>Musiques - ECE Amazon</title> 
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
	<div>
		
		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<?php
			if (isset($nbproduct)) {
				if ($nbproduct > 0) {

					$var = $buyproduct->fetchAll(PDO::FETCH_OBJ);
					echo "<table class='table'>
					<caption>Musiques actuellement disponibles:</caption>
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

					$size=100;
					foreach($var as $elem=>$value)
					{
						$loc=$dossier . $value->Photo;
						echo "<tr><td>";
						echo"<img src=".$loc." width='$size' height='$size'/>";
						echo "</td><td><a href='page-produit.php?Id=".$value->Id_produit."'>";
						echo $value->Nom;
						echo "</a></td><td>";
						echo $value->Prix;
						echo "€</td><td>";
						echo $value->Stock;
						echo "</td><td><a href='page-produit.php?Id=".$value->Id_produit."'><input type='submit' value='Acheter' name=".$value->Id_produit."></a></td>";
						echo "</tr>";
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