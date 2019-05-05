<?php
session_start();

//Connexion BDD
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
	$id_vendeur_temp=$_SESSION["Id_vendeur"];
	$buyproduct=$conn->prepare("SELECT * FROM produit WHERE Id_vendeur = $id_vendeur_temp");
	$buyproduct->execute();
	$nbproduct=$buyproduct->rowCount();
	
}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false)
{
	header('location: connexion_vendeur.php');
}

?>


<!DOCTYPE html> 

<!--LISTE DES ITEMS DU VENDEUR-->
<html> 
	<head> 
		<meta charset="utf-8"> 
		<title>Vos Items - ECE Amazon</title> 
		<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="Style.css" rel="stylesheet" type="text/css"/>
	<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	
	<!--BODY-->
	
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
			echo "<div><div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='Choix-Items-Admin.php' style='color : white'>Items</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='Choix-Vendeur-Admin.php' style = 'color : white '>Vendeurs</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(174,174,174);'> <a href='vendeur-votrecompte.php' style = 'color : white'>Votre compte</a></div>
        <br><br>
		</div>"	;
		}		
	?>
 
    <br>
		
		<div class="titre"> Vos items </div>
		
		
		<div>
			
		<div class="col-sm-2">

		</div>
		<div class="col-sm-8">
			<?php
			
			if (isset($nbproduct)) {
				if ($nbproduct > 0) {

					$var = $buyproduct->fetchAll(PDO::FETCH_OBJ);
					echo "<table class='table'>
					<tr>
					<th>Image</th>
					<th>Nom</th>
					<th>Prix</th>
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
						echo "€</tr>";
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

