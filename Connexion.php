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
$phrasewelcome="";

if (isset($_SESSION["nom"])&&isset($_SESSION["prenom"])) {
	$phrasewelcome= "<h2>Bienvenu ". $_SESSION["prenom"] . " " . $_SESSION["nom"] . "</h2><h2>Maintenant que vous avez créé votre compte vous pouvez vous connecter.</h2><br>";
}
else{
	$phrasewelcome= "<h2>Bienvenu</h2><br>";
}

if (isset($_POST['connexion_acheteur'])) {

	$identifiant = isset($_POST["identifiant"])? $_POST["identifiant"] : "";
	$password = isset($_POST["password"])? $_POST["password"] : "";

	if (!empty($password)&&!empty($identifiant)){
		if ($conn)
		{

			$verifuser=$conn->prepare("SELECT * FROM acheteur WHERE Pseudo = ? AND Mdp = ?");
			$verifuser->execute(array($identifiant,$password));
			$userexiste = $verifuser->rowCount();

			if ($userexiste == 1) {
				$getiduser=$conn->prepare("SELECT * FROM acheteur WHERE Pseudo LIKE '$identifiant' AND Mdp LIKE '$password'");
				$getiduser->execute();
				$var=$getiduser->fetchAll(PDO::FETCH_OBJ) ;
				foreach($var as $elem=>$value)
				{
					$_SESSION["Id_client"]=$value->Id_acheteur;
					$_SESSION["nom"]=$value->Nom;
					$_SESSION["prenom"]=$value->Prenom;
				}
				header('location: acheteur-votrecompte.php');
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
					<div class="homestyle">
						<!--Esthetique de connexion, si on vient de creer le compte ou non-->
						<?php
						echo $phrasewelcome;
						?>
					</div>
					
					<!--Notre formulaire de connection-->
					<form action="" method="post" class="col-sm-offset-3 col-sm-5">		
						<legend>Connectez-vous</legend>
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
						<div class="col-sm-6">
							<button name="connexion_acheteur" type="submit" class="btn btn-primary btn-lg">Connexion</button>
						</div>
						<div class="col-sm-6">
							<?php
							echo $erreur;
							?>
						</div>

					</form>

					

					<div class= "col-sm-offset-6 "><br><br><br>
						
						<!--Boutons pour creer un compte et se connecter en tant que vendeur-->
						
						<div>
							<a href="compte_acheteur.php">
								<button type="submit" class="btn btn-primary btn-lg">Créer un compte</button> </a> <br> <br>
							</div>

							<div>
								<a href="connection_vendeur.html">
									<button type="submit" class="btn btn-primary btn-lg">Vous etes vendeur</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Lien vers la page d'accueil-->
			<a href="Page_accueil.html">Acceder directement au site</a> 
			
		</div>
	</body>
	</html>