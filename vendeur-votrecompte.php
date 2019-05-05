<?php
session_start();

// verifie la bonne connexion a la base de donnée
$servername = "localhost";
$username = "root";
$password = "";
$dossier_vendeurs = "vendeurs/";
$dossier_fond="fonds/";


try {
    $conn = new PDO("mysql:host=$servername;dbname=eceamazon", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // echo "Connected successfully <br>"; 
    }

      catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

$test=$_SESSION["Id_vendeur"];

$sql = "SELECT * FROM vendeur WHERE Id_vendeur ='$test'"; 
$req = $conn->query($sql); 


//fetch recupere les donnes lignes par lignes
if ($req->rowCount() > 0) {
    // output data of each row
    while($row = $req->fetch()) 
	{
		
        /*echo "Nom: " . $row["Nom"]. "<br> Prenom: " . $row["Prenom"]. " <br> Pseudo" . $row["Pseudo"]. "<br>Email:". $row["Mail"]. " <br> Photo : " . $row["Photo"]. "<br>";*/
		$test=$row["Photo"];
			
    }
}

else
{
    echo "0 results";
}

if (isset($_POST['Deconnexion'])) {
	session_start();
	session_unset();
	session_destroy();
}
if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true)
{

}
if(!isset($_SESSION["Connected_vendeur"])||$_SESSION["Connected_vendeur"]==false)
{
	header('location: connexion_vendeur.php');
}


  
?>

<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8"> 
		<title>Votre Compte Vendeur - ECE Amazon</title> 
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
		
	<div>
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
		
	</div>
 
    <br>
		<div class="col-sm-12">
			<div class="row">
			
			<div class="overlay">
				<?php		
				$fullpath=$dossier_fond. $_SESSION["photo_fond"];
			
				
				echo " 
	<style>
	.overlay
{ 
	background-image: url('$fullpath');
} 
</style>";

?> 
		<div>
			<div>
				<p><a href="<?php echo $dossier_vendeurs . $test; ?>"> <img class="ph_profil" src="<?php echo $dossier_vendeurs . $test; ?>"> </a></p>
			</div>
		<div>
				<br>
			<p class="texte">
			 <?php
        		echo "<h2>Bienvenue ". $_SESSION["prenom"] . " " . $_SESSION["nom"];
        		echo "</h2><h2>Votre n°vendeur est : " . $_SESSION["Id_vendeur"] . "</h2>";
		 		echo "<h2>Votre Pseudo est : ". $_SESSION["pseudo"];
             ?>
			</p>
			
		    <div>
				    <!--Bouton pour etre redirigé vers la page de connexion_vendeur-->
						
						<a href="vendeur-items.php">
							<button type="submit" class="btn btn-primary btn-lg">Liste de vos items
							</button> 
						</a>
					<div>
						<br>
						<form action='' method='post'>
						<input type="submit" value="Deconnexion" name="Deconnexion" class="btn btn-primary btn-lg">
						</form>
					</div>
			</div>
		</div>
			 


		</div>
			</div>
				</div>
		
		
		
</div>

	</body>
	
	
</html>




 