<?php
session_start();

if (isset($_POST['Deconnexion'])) {
    session_start();
    session_unset();
    session_destroy();
}

if (isset($_SESSION["Connected_acheteur"])&&$_SESSION["Connected_acheteur"]==true) {

}
if(!isset($_SESSION["Connected_acheteur"])||$_SESSION["Connected_acheteur"]==false){
	header('location: Connexion.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Votre Compte</title>
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
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-categories.php" style="color : white">Catégories</a></div>
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-ventesflash.php" style = "color : white ">Ventes flash</a></div>
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
            <div class="col-sm-1 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-panier.php"> <img src="panier1.png" alt="logo" width=45 height="45" /> </a> </div>
            <div class="col-sm-2 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="acheteur-votrecompte.php" style = "color : white">Votre compte</a></div>
        <br>
	</div>
 
    <br>
    <div class="col-sm-3"></div>
    <div class="col-sm-6 choicestyle" style="text-align: center;">
        <h3>Votre compte</h3>
        <?php
        echo "<h3>Bienvenue ". $_SESSION["prenom"] . " " . $_SESSION["nom"];
        echo "</h3><br><h3>Votre n°client est : " . $_SESSION["Id_client"] . "</h3>";
        ?>
        <div>
            <br>
            <form action='' method='post'>
                <input type="submit" value="Deconnexion" name="Deconnexion" class="btn btn-primary btn-lg">
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>

</body>
</html>




