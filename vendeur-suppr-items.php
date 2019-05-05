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
if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true) {

	$id_product=$_GET['Id'];
	$buyproduct=$conn->prepare("SELECT * FROM produit WHERE Id_produit = $id_product");
	$buyproduct->execute();
	$nbproduct=$buyproduct->rowCount();
	if (isset($_POST['Supprimer_item'])) {
		$requete = $conn->prepare("DELETE FROM produit WHERE Id_produit = $id_product");
		$requete->execute();
		header('location: vendeur-suppr.php');
	}

}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false){
	header('location: connexion_vendeur.php');
}

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8"> 
<title>Suppression Produit - ECE Amazon</title> 
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
			<div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-vendre.php" style="color : white">Vendre un item</a></div>
			<div class="col-sm-3 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="vendeur-suppr.php" style = "color : white ">Supprimer un item</a></div>
			<div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
			<div class="col-sm-2 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="vendeur-votrecompte.php" style = "color : white">Votre compte</a></div>
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
						echo "<div class='col-sm-4'><br><br><a href='page-produit.php?Id=".$value->Id_produit."'><h3>";
						echo $value->Nom;
						echo "</h3></a><br><h4>";
						echo $value->Description;
						echo "</h4><br><h3>";
						echo $value->Prix;
						$method="post";
						echo "€</h3><br><br><form action='' method='$method'><input type='submit' value='Supprimer' name='Supprimer_item'></form>";
						echo "</div>";

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