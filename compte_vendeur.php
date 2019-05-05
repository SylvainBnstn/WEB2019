<?php  
//Connexion BDD 
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


//verification taille de l'image
if(isset($_POST['envoie_form_compte_vendeur']))
{
	//recuperer les données venant de la page HTML  
$nom= isset($_POST["nom"])? $_POST["nom"] : "";
$prenom= isset($_POST["prenom"])? $_POST["prenom"] : "";
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : ""; 
$email= isset($_POST["email"])? $_POST["email"] : "";
$photo = isset($_FILES["photo"]["name"])? $_FILES["photo"]["name"] : "";
$mdp2 = isset($_POST["mdp2"])? $_POST["mdp2"] : "";
$photo_fond = isset($_FILES["photo_fond"]["name"])? $_FILES["photo_fond"]["name"] : "";

//recurperation des variables nom et prenom avce la variable superglobal SESSION
$_SESSION["nom"]=$nom;
$_SESSION["prenom"]=$prenom;

//vendeur de type 1=vendeur,  types 2 = admin
$type="1";
$erreur="";
	
	if(filesize($_FILES["photo"]["tmp_name"] > 100000))//Si la taille est superieur a 100Ko 
{
	$erreur= "Vous devez telecharger un fichier de taille inferieur a 100Ko";
}

	
	
	
//les types d'image que l'on autorise
$ext_accepte = array( 'jpg', 'jpeg', 'png');
//on verifie que le fichier mis par le vendeur est bien de ce type
$ext_telecharge =strtolower( substr( strrchr($_FILES["photo"]["name"], '.')  ,1)  );
if ( in_array($ext_telecharge,$ext_accepte) ) 
	
{
	//echo "Extension de la photo correcte <br>";
}

else
{
	$erreur= "Vous devez telecharger un fichier jpg, jpeg ou png<br>";
}
	

//on verifie que le fichier mis par le vendeur comme fond d ecran est bien de ce type
$ext_telecharge1 =strtolower( substr( strrchr($_FILES["photo_fond"]["name"], '.')  ,1)  );
if ( in_array($ext_telecharge1,$ext_accepte) ) 
	
{
	
	//echo "Extension de la photo correcte <br>";
}

else
{
	$erreur= "Vous devez telecharger un fichier jpg, jpeg ou png<br>";
}
	

if(($_FILES["photo"]))
{ 
     $dossier = "vendeurs/";
	//move_uploaded_file renvoi true si ca a fonctionné
     if(move_uploaded_file($_FILES["photo"]["tmp_name"], $dossier . $photo)) 
     {

          //echo 'Telechargement de la photo reussi <br>';
     }
     else //False sinon 
     {
          $erreur .= 'Echec du telechargement de la photo <br>';
     }
}
	
	if(($_FILES["photo_fond"]))
{ 
     $dossier_fond = "fonds/";
		
	//move_uploaded_file renvoi true si ca a fonctionné
     if(move_uploaded_file($_FILES["photo_fond"]["tmp_name"], $dossier_fond . $photo_fond)) 
     {
          //echo 'Telechargement de la photo reussi <br>';
     }
     else //False sinon 
     {
          $erreur .= 'Echec du telechargement de la photo <br>';
     }
}

	
	
    
   //verification champs vides du formulaire
   if(!empty($prenom)&&!empty($nom)&&!empty($pseudo)&&!empty($mdp)&&!empty($email)&&!empty($photo)&&!empty($mdp)&&($mdp2 == $mdp)&&!empty($photo_fond)) 
   {
	   if($conn)
	   {
		   //verifie que l'email saisi n'est pas deja dans la BDD
		    $verifmail=$conn->prepare("SELECT * FROM vendeur WHERE Mail = ?");
        	$verifmail->execute(array($email));
        	$mailexiste = $verifmail->rowCount();
		 
            //verifie que le pseudo choisi n'est pas deja dans la BDD
        	$verifpseudo=$conn->prepare("SELECT * FROM vendeur WHERE Pseudo = ?");
        	$verifpseudo->execute(array($pseudo));
        	$pseudoexiste = $verifpseudo->rowCount();
		   
		   

        	if (($mailexiste == 0)&&($pseudoexiste == 0)) //Si pseudo et email rentré ne sont pas deja dans la BDD
			{		   
		   
	   //Insertion des données du formulaire dans la BDD
	   $sql = $conn->prepare("INSERT INTO vendeur (Nom, Prenom, Pseudo, Photo, Type, Mail, Mdp,Photo_fond) VALUES ('$nom','$prenom','$pseudo','$photo','$type','$email','$mdp','$photo_fond')");
          $sql->execute([$nom,$prenom,$pseudo,$photo,$type,$email,$mdp,$photo_fond]); 
				$last_id = $conn->lastInsertId();
            	$_SESSION["Id_user"]=$last_id;   
	           header('location: connexion_vendeur.php');//renvoie a la page de connexion du vendeur
		
	         }
		   
		   else
			{
        		if ($pseudoexiste != 0) //Si pseudo deja present dans la BDD
				{
					
        			$erreur .= "Le pseudo choisi existe deja. <br>"; 
        		}
        		if ($mailexiste != 0) //Si mail deja present dans la BDD
				{
        			$erreur .= "L'email choisi est deja utilisé. <br>";
        		}
        	} 
	   
      }
   }
 else
 {
	 //affiche les champs vides
	if(!($prenom)) {$erreur .= "Le champ prenom est vide. <br>";}
    if(!($nom)) {$erreur .= "Le champ nom est vide. <br>";}
    if(!($pseudo)) {$erreur .= "Le champ pseudo est vide. <br>";}
    if(!($mdp)) {$erreur .= "Le champ mot de passe est vide. <br>";}
	if(!($mdp2)) {$erreur .= "Le champ verification du mot de passe est vide. <br>";}
    if(!($email)) {$erreur .= "Le champ email est vide. <br>";}
    if(!($photo)) {$erreur .= "Le champ photo est vide. <br>";} 
	if(!($photo_fond)) {$erreur .= "Le champ photo fond d'ecran est vide. <br>";} 
	if($mdp2 != $mdp){$erreur .= "Les mots de passe sont différents. <br>";} 
 }
	
}

?>

<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8"> 
		<title>Création Compte Vendeur - ECE Amazon</title> 
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
		
	<!--Logo-->
		<div>
		<img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
		</div>
		<div>
				<!--Centre le texte qui n'est pas dans un formulaire-->
			
		
			<div class="connexion_form">
				
			<div class="container-fluid">
				
				
				<div class="row">	
				 <legend>Creez votre compte</legend>
				 </div>
					<!--Formulaire fait 12 colones-->
				<form class="form-horizontal col-sm-12" method="post" action="" enctype="multipart/form-data" class="needs-validation">
					<!--enctype expedie un fichier attaché a un message--> 
					
						<!--Premiere moitie de page (6 colones)-->
				   <div class="col-sm-6">
			          <!--Prenom-->
				     <div class="row">
                      <div class="form-group">
                       <label for="prenom" class="col-sm-3 control-label">Prenom : </label>
                         <div class="col-sm-9">
                           <input name ="prenom" placeholder="Votre prenom" type="text" class="form-control"required>
                        </div>
                      </div>
		              </div>
					   
					   
					   <!--Nom-->

                   <div class="row">
                    <div class="form-group">
                     <label for="nom" class="col-sm-3 control-label">Nom : </label>
                       <div class="col-sm-9">
                        <input name ="nom" placeholder="Votre nom" type="text" class="form-control"required>
                        </div>
                    </div>
		           </div>
					   <!--Pseudo-->
					
				<div class="row">
                  <div class="form-group">
                   <label for="pseudo" class="col-sm-3 control-label">Pseudo : </label>
                     <div class="col-sm-9">
                      <input name ="pseudo" placeholder="Votre Pseudo" type="text" class="form-control"required>
                     </div>
                  </div>
		        </div>
					   
					      <!--Mot de passe-->
					<div class="row">
                      <div class="form-group">
                      <label for="mdp" class="col-sm-3 control-label">Mot de passe : </label>
                      <div class="col-sm-9">
                       <input name ="mdp" placeholder="Votre mot de passe" type="password" class="form-control"required>
                     </div>
                     </div>
		            </div>
					   
					   <div class="row">
                      <div class="form-group">
                      <label for="mdp" class="col-sm-3 control-label">Confirmation mot de passe : </label>
                      <div class="col-sm-9">
                       <input name ="mdp2" placeholder="Confirmation mot de passe" type="password" class="form-control"required>
                     </div>
                     </div>
		            </div>
					   <!--Email-->
					
				<div class="row">
                  <div class="form-group">
                   <label for="email" class="col-sm-3 control-label">Email : </label>
                 <div class="col-sm-9">
                    <input name ="email" placeholder="Votre Email" type="email" class="form-control"required>
                 </div>
                 </div>
		        </div>
					   
					   
			</div>
					
					
					<!-- Deuxieme moitie de page (de la 6eme a la 12eme colone)-->
				<div class="col-sm-6">
				<!-- Photo-->

					<div class="row">
                     <div class="form-group">

                       <div class="col-sm-offset-3 col-sm-9">
				      <!--<img src="Profil.jpg" class="img-circle">-->
                            <!--<input type="file" name="image">-->
						   <!--<input name ="photo" placeholder="Nom de la photo a charger" type="text" class="form-control">-->
						   <div>
						   <div>
						   <label for="photo">  Photo (tous formats | max. 100 Ko) :</label><br />
							</div>
                           <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						   <input type="file" name="photo"/><br />
							   </div>
						   
						   
						   <div>
						   <div>
						   <label for="photo_fond">  Choisir votre photo de fond d'ecran</label><br />
							</div>
                           <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						   <input type="file" name="photo_fond"/><br />
						 </div>
						   
                       </div>  
                     </div>
		          </div>
				</div>
					
					 <!--Bouton pour creer le contact-->
					<div class="col-sm-7">
					<div class="row">
				  <div class="form-group">
					  
                   <input type="submit" class="pull-right btn btn-default" name="envoie_form_compte_vendeur" value="Creer mon compte vendeur"/>
                    </div> 
					</div>
					</div>
					
					<div class="row">
					<div class="col-sm-3" style="text-align: center;">
					<?php
         				if((isset($erreur))&&($erreur!="")) 
						{
            			echo '<font color="red">'.$erreur."</font>";
         				}
         			?> 
     			</div>
				</div>
					
               </form>
				
	            

		    </div>
				    <!--Bouton pour etre redirigé vers la page de connexion_vendeur-->
					<div class="col-sm-3">
						<a href="connexion_vendeur.php">
							<button type="submit" class="btn btn-primary btn-lg">Connexion
							</button> 
						</a>
					</div>
		</div>
				</div>
			
		
	</body>
</html> 
					










 