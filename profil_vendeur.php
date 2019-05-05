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
	$id_vendeur=$_GET['Idv'];
	$suppr_vendeur=$conn->prepare("SELECT * FROM vendeur WHERE Id_vendeur = $id_vendeur");
	$suppr_vendeur->execute();
	$nb_vendeur=$suppr_vendeur->rowCount();
	if (isset($_POST['Supprimer_vendeur'])) {
		$requete = $conn->prepare("DELETE FROM vendeur WHERE Id_vendeur = $id_vendeur");
		$requete->execute();
		header('location: Suppression-Vendeur-Admin.php');
	}
	
	
}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false){
	header('location: connexion_vendeur.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Suppression Vendeurs - Admin - ECE Amazon</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	
	
<body>
	<div>
		<a href="Accueil-Admin.html">
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
		</a>
	</div>
	<div>
           <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="Choix-Items-Admin.php" style="color: white">Items</a></div>
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(174,174,174);"><a href="Choix-Vendeur-Admin.php" style="color: white">Vendeurs</a></div>		
            <div class="col-sm-4 toolbarstyle" style="background-color: rgb(74,74,74);"><a href="vendeur-votrecompte.php" style="color: white">Votre Compte</a></div>
	</div>
	
	
		<div>
	<div>
		<div class="col-sm-1" style="background-color: white;"></div>
		<div class="col-sm-10 choicestyle" style="background-color: white;">
			<h3>Voulez-vous vraiment supprimer ce vendeur </h3>
		</div>
	</div>
	
	

		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<?php
			if (isset($nb_vendeur)) {
				if ($nb_vendeur > 0) {

					$var = $suppr_vendeur->fetchAll(PDO::FETCH_OBJ);

                        // parcourt de chaque ligne
					$dossier="vendeurs/";

					$size=350;
					foreach($var as $elem=>$value)
					{
						$loc=$dossier . $value->Photo;
						echo "<div class='col-sm-3'></div><div class='col-sm-4'>";
						echo"<img src=".$loc." width='$size' height='$size'/></div>";
						echo "<div class='col-sm-4'><br><br><h3>";
						echo $value->Nom;
						echo "</h3><br><h4>";
						echo $value->Prenom;
						echo "</h4><br><h3>";
						echo $value->Mail;
						$method="post";
						echo "</td><td><form action='' method='$method'><input type='submit' value='Supprimer' name='Supprimer_vendeur'></form></td>";
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