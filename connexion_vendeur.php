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

$erreur="";

if (isset($_POST['connexion_vendeur'])) {

	$identifiant = isset($_POST["identifiant"])? $_POST["identifiant"] : "";
	$password = isset($_POST["password"])? $_POST["password"] : "";


	if (!empty($password)&&!empty($identifiant)){
		if ($conn)
		{

			$verifuser=$conn->prepare("SELECT * FROM vendeur WHERE Pseudo = ? AND Mdp = ?");
			$verifuser->execute(array($identifiant,$password));
			$userexiste = $verifuser->rowCount();

			if ($userexiste == 1) {
				$getiduser=$conn->prepare("SELECT * FROM vendeur WHERE Pseudo LIKE '$identifiant' AND Mdp LIKE '$password'");
				$getiduser->execute();
				$var=$getiduser->fetchAll(PDO::FETCH_OBJ) ;
				foreach($var as $elem=>$value)
				{
					$_SESSION["Id_vendeur"]=$value->Id_vendeur;
					$_SESSION["nom"]=$value->Nom;
					$_SESSION["prenom"]=$value->Prenom;
					$_SESSION["type_profil"]=$value->Type;
					$_SESSION["Connected_vendeur"]=true;
				}
				if ($_SESSION["type_profil"]==2) {
					header('location: Accueil-Admin.php');
				}
				if ($_SESSION["type_profil"]==1) {
					header('location: vendeur-votrecompte.php');
				}
				
			}
			else{
				$erreur .= "Les identifiants saisie sont incorrect. <br>";
			}
		}
	}
	else{
		if(!($identifiant)) {$erreur .= "Le champ Identifiant est vide. <br>";}
		if(!($password)) {$erreur .= "Le champ Password est vide. <br>";}             		
	}

}


?>

<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>Site ECE Amazon</title> 
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

	<div>
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
	</div>

	<div>

		<div class="connexion_form">

			<div class="container-fluid">
				
				<div class="row">

					<!--Notre formulaire de connection-->
					<form action="" method="post" class="col-sm-offset-3 col-sm-5">		
						<legend>Connectez-vous en tant que vendeur</legend>
						<!--Identifiant-->
						<div class="form-group">
							<label for="identifiant">Identifiant </label>
							<input name ="identifiant" id="identifiant" type="text" class="form-control" required>
						</div>
						
						<!--Mot de passe-->
						<div class="form-group">
							<label for="password"> Password</label>
							<input name="password" id="password" type="password" class="form-control" required>	
						</div>
						<!--Bouton de soumission-->
						<button name="connexion_vendeur" type="submit" class="btn btn-primary btn-lg">Connexion vendeur</button>

					</form>


					<div class= "col-sm-offset-6 col-sm 5"><br><br><br>

						<!--Bouton pour creer un compte vendeur -->
						<div>
							<a href="compte_vendeur.html">
								<button type="submit" class="btn btn-primary btn-lg">Créer un compte vendeur</button> <br> <br> 
							</a>
						</div>
					</div>
					<div class="col-sm-6">
						<?php
						echo $erreur;
						?>
					</div>
				</div>
			</div>
			
		</div>

		<!--Lien vers la page d'accueil-->
		<a href="Page_accueil.html">Acceder directement au site</a> 

	</div>
</body>
</html> 