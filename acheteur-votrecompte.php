<?php
session_start();
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
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-categories.html" style="color : white">Catégories</a></div>
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-ventesflash.html" style = "color : white ">Ventes flash</a></div>
            <div class="col-sm-3 toolbarstyle" style="background-color: rgb(74,74,74);"> </div>
            <div class="col-sm-1 toolbarstyle" style="background-color: rgb(74,74,74);"> <a href="acheteur-panier.html"> <img src="panier1.png" alt="logo" width=45 height="45" /> </a> </div>
            <div class="col-sm-2 toolbarstyle" style="background-color: rgb(174,174,174);"> <a href="acheteur-votrecompte.php" style = "color : white">Votre compte</a></div>
        <br>
	</div>
 
    <br>
    <div class="col-sm-3"></div>
    <div class="col-sm-6 choicestyle" style="text-align: center;">
        <h2>Votre compte</h2>
        <?php
        echo "<h2>Bienvenu ". $_SESSION["prenom"] . " " . $_SESSION["nom"];
        echo "</h2><br><h2>Votre n°client est : " . $_SESSION["Id_client"] . "</h2>";
        ?>
    </div>
    <div class="col-sm-3"></div>

</body>
</html>



