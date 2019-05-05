<?php  
session_start();
//recuperer les données venant de la page HTML  
//le parametre de $_POST = "name" de <input> de votre page HTML  
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=eceamazon", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

if (isset($_SESSION["Connected_vendeur"])&&$_SESSION["Connected_vendeur"]==true) 
{
	if(isset($_POST['envoie_creer_article']))
	{
		


		$nom= isset($_POST["nom"])? $_POST["nom"] : "";
		$description = isset($_POST["description"])? $_POST["description"] : ""; 
		$prix= isset($_POST["prix"])? $_POST["prix"] : "";
		$photo = isset($_FILES["photo"]["name"])? $_FILES["photo"]["name"] : "";
		$video= " ";
		$stock= isset($_POST["stock"])? $_POST["stock"] : "";
		if(isset($_POST['taille_article'])){foreach ($_POST['taille_article'] as $taille_article){}}
		if(isset($_POST['couleur_article'])){foreach ($_POST['couleur_article'] as $couleur_article){}}

		$type="4";
		//voir pour id_vendeur
		//video 
		//photo verif



		$id_vendeur=$_SESSION["Id_vendeur"];

		if(filesize($_FILES["photo"]["tmp_name"] > 100000))
		{
			$erreur= "Vous devez telecharger un fichier de taille inferieur a 100Ko";
		}

		//les types qu'on autorise
		$ext_accepte = array( 'jpg', 'jpeg', 'png' );
		//on verifie que le fihier est bien de ce type
		$ext_telecharge =strtolower( substr( strrchr($_FILES["photo"]["name"], '.')  ,1) );
		
		if (in_array($ext_telecharge,$ext_accepte)) 

		{
			//echo "Extension correcte";
		}

		else
		{
			$erreur= "Vous devez telecharger un fichier jpg, jpeg ou png";
		}


		if(($_FILES["photo"]))
		{ 
			$dossier = "items/";
			$fichphoto = $dossier . $photo;

			//move_uploaded_file renvoi true si ca a fonctionné
			 if(move_uploaded_file($_FILES["photo"]["tmp_name"], $dossier . $photo)) 
			 {
				 $requete = $conn->prepare("INSERT INTO produit (Type,Nom, Photo, Description, Prix,Video,Id_vendeur,Couleur,Taille,Stock) VALUES('$type','$nom','$photo','$description','$prix','$video','$id_vendeur','$couleur_article','$taille_article','$stock')");
				 $requete->execute([$type,$nom,$photo,$description,$prix,$video,$id_vendeur,$couleur_article,$taille_article,$stock]);

			 }
			 else 
			 {
				  echo 'Echec du telechargement !';
			 }

		}
		
		
	}
	
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
		<title>Vendre Produit - ECE Amazon</title> 
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
			echo "<div><div class='col-sm-4 toolbarstyle' style='background-color: rgb(174,174,174);'> <a href='Choix-Items-Admin.php' style='color : white'>Items</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='Choix-Vendeur-Admin.php' style = 'color : white '>Vendeurs</a></div>";
            echo "<div class='col-sm-4 toolbarstyle' style='background-color: rgb(74,74,74);'> <a href='vendeur-votrecompte.php' style = 'color : white'>Votre compte</a></div>
        <br><br>
	</div>"	;
		}		
		?>

 <div>
	 <br>
	 <div class="container-fluid">
		 
			<div class="row">	
				<h3 style="text-align:center">Rentrer les infos de l'item</h3>
			</div>


 	<!--Formulaire fait 12 colones-->
				<form class="form-horizontal col-sm-12" method="post" action="" enctype="multipart/form-data" class="needs-validation" class="form-inline">
					
						<!--Premiere moitie de page (6 colones)-->
				   <div class="col-sm-6">
					   
					   <!--Nom-->
				     <div class="row">
                      <div class="form-group">
                       <label for="nom" class="col-sm-3 control-label">Nom : </label>
                         <div class="col-sm-9">
                           <input name ="nom" id="nom" placeholder="Nom de l'article" type="text" class="form-control"required>
                        </div>
                      </div>
		             </div>
					   <br>
					   
					   <!--Description-->
                   <div class="row">
                    <div class="form-group">
                     <label for="descritpion" class="col-sm-3 control-label">Description : </label>
                       <div class="col-sm-9">
                        <input name ="description" id="descritpion" placeholder="Descritpion de l'article" type="text" class="form-control"required>
                        </div>
                    </div>
		           </div>
					   <br>

					   
					      <!--Prix-->
				<div class="row">
                   <div class="form-group">
					  <label for="prix" class="col-sm-3 control-label">Prix : </label>
                        <div class="input-group col-sm-9">
                             <input name ="prix" id="prix" placeholder="Le prix" type="number" class="form-control"required>
							<span class="input-group-addon">€</span>
                      </div>
                    
					</div>
				</div>  
					   
					  
					          <!--Taille de l'article en menu deroulant-->
					<div class="row">
                         <div class="form-group">
                            <label for="taille_article" class="col-sm-3 control-label">Taille de l'article : </label>
                              <div class="col-sm-9">  
						        <select name="taille_article[]" class="form-control">
									<option> XS </option>
									<option> S </option>
									<option>M </option>
									<option>L </option>
									<option>XL </option>
								
                                </select> 
                             </div>
                          </div>
		            </div>
					   
					   <br>
					   	   
					   <!--Couleur de l'article-->
                   
                   	<div class="row">
                         <div class="form-group">
                            <label for="couleur_article" class="col-sm-3 control-label">Couleur: </label>
                              <div class="col-sm-9">  
						        <select name="couleur_article[]" class="form-control">
									<option> noir </option>
									<option> blanc </option>
									<option>jaune </option>
									<option> rouge </option>
									<option> vert </option>
									<option> bleu clair </option>
									<option>bleu fonce </option>
									<option> rose </option>
									<option> orange </option>
									<option> beige </option>
									<option> gris </option>
									<option> marron </option>
                                </select> 
                             </div>
                          </div>
		            </div>
					   
					
					
					<!--Stock-->
					<div class="row">
						<div class="form-group">
							<label for="stock" class="col-sm-3 control-label">Stock : </label>
							<div class="col-sm-9">
								<input name ="stock" id="stock" placeholder="Vos stocks" type="number" class="form-control"required>
							</div>

						</div>
					</div>
					   
					   

			</div>
					
					
					<!--Deuxieme moitie de page-->
				
					<div class="col-sm-6">
						
					<div class="row">
                        <div class="form-group">
                         <div class="col-sm-offset-4 col-sm-8">
				            <div>
						   <label for="photo">  Photo (tous formats | max. 100 Ko):</label><br />
							</div>
                           <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						   <input type="file" name="photo"/><br />
	  
                         </div>  
                     </div>
		            </div>
	      	      </div>
					
					 <div class="row">
					 <div class="col-sm-offset-9 col-sm-3">
					<div class="form-group">
                   <input type="submit" class="pull-right btn btn-default" name="envoie_creer_article" value="Ajouter l'article "/><br> <br>
                   </div>
						 </div>
						 </div>
					
					
					
              </form>
	 </div>
		</div>
		
	</body>
</html>