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

if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true)
{
	
	$supprproduct=$conn->prepare("SELECT * FROM produit");
	$supprproduct->execute();
	$nbsuppr=$supprproduct->rowCount();

}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false){
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
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
		
	</div>
	<div>
           <div class="col-sm-4 toolbarstyle" style="background-color: rgb(174,174,174);"><a href="Choix-Items-Admin.php" style="color: white">Items</a></div>
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="Choix-Vendeur-Admin.php" style="color: white">Vendeurs</a></div>		
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="vendeur-votrecompte.php" style="color: white">Votre Compte</a></div>
	</div>
	
	
		<div>
	<div>
		<div class="col-sm-1" style="background-color: white;"></div>
		<div class="col-sm-10 choicestyle" style="background-color: white;">
			<h3>Selectionner les vendeurs que vous souhaitez supprimer </h3>
		</div>
	</div>
	
	

		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<?php
			if (isset($nbsuppr)) {
				if ($nbsuppr > 0) {

					$var = $supprproduct->fetchAll(PDO::FETCH_OBJ);
					echo "<table class='table'>
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
						if ($value->Stock > 0) {
							$loc=$dossier . $value->Photo;
							echo "<tr><td>";
							echo"<img src=".$loc." width='$size' height='$size'/>";
							echo "</td><td>";
							echo $value->Nom;
							echo "</td><td>";
							echo $value->Prix;
							echo "</td><td><a href='produit_suppr_admin.php?Id=".$value->Id_produit."'><input type='submit' value='Supprimer' name=".$value->Id_produit."></a></td>";
							echo "</tr>";
						}
						
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