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
	$phrasewelcome= "<h3>Bienvenue ". $_SESSION["prenom"] . " " . $_SESSION["nom"] . "</h3><h3>Maintenant que vous avez créé votre compte vous pouvez vous connecter.</h3><br>";
}
else{
	$phrasewelcome= "<h3>Bienvenue</h3><br>";
}

if (isset($_POST["Acces_site"])) {

	$nb_user_bdd=$conn->prepare("SELECT * FROM acheteur");
	$nb_user_bdd->execute();
	$nb_tot_user_bdd=$nb_user_bdd->rowCount();

	$nb_user_default=0;

	for ($i=0; $i < $nb_tot_user_bdd; $i++) { 

		$user_words="default".$i;	
		$user_default_bdd=$conn->prepare("SELECT * FROM acheteur WHERE Nom = '$user_words' AND Prenom = '$user_words' AND Pseudo = '$user_words' ");
		$user_default_bdd->execute();
		$nb_user_temp=$user_default_bdd->rowCount();

		if ($nb_user_temp!=0) {

			$nb_user_default++;
		}
	}

	$nom="default".$nb_user_default;
	$prenom="default".$nb_user_default;
	$mdp="default".$nb_user_default;
	$pseudo="default".$nb_user_default;
	$adresse="default";
	$adresse2="default";
	$ville="default";
	$code_postal="75001";
	$pays="default";
	$telephone="0100000001";
	$email="default";
	$numero_carte="2050205";
	$type_carte="Visa";
	$nom_proprio="default";
	$expiration="2050-01-01";
	$crypto="100";

	$creer_user_vide=$conn->prepare("INSERT INTO acheteur (Nom, Prenom, Mdp, Pseudo, Adresse1, Adresse2, Ville, CodePostal, Pays, Num_tel, Mail, Numero_carte, Type_carte, Nom_carte, Date_expi, Code_secu) VALUES ('$nom','$prenom','$mdp','$pseudo','$adresse','$adresse2','$ville','$code_postal','$pays','$telephone','$email','$numero_carte','$type_carte','$nom_proprio','$expiration','$crypto')");
    $creer_user_vide->execute([$nom,$prenom,$mdp,$pseudo,$adresse,$adresse2,$ville,$code_postal,$pays,$telephone,$email,$numero_carte,$type_carte,$nom_proprio,$expiration,$crypto]);

    $last_id = $conn->lastInsertId();
    $_SESSION["Id_user"]=$last_id;
    $_SESSION["Id_client"]=$_SESSION["Id_user"];
	$_SESSION["nom"]=$nom;
	$_SESSION["prenom"]=$prenom;
	$_SESSION["Connected_acheteur"]=true;
	$_SESSION["Default_user"]=true;       
    header('location: acheteur-ventesflash.php');
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
				$_SESSION["Connected_acheteur"] = true;
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
	<title>Connexion Acheteur - ECE Amazon</title> 
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
								<a href="connexion_vendeur.php">
									<button type="button" class="btn btn-primary btn-lg">Vous etes vendeur</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<form action="" method="post">
				<input class='btn btn-primary btn-lg' type='submit' value='Acceder directement au site' name="Acces_site">
			</form>
			
		</div>
	</body>
	</html>