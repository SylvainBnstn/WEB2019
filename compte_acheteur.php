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

    if (isset($_POST['envoie_form_compte_acheteur'])) {
	    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
	    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";  
	    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
	    $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
	    $adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
	    $adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
	    $ville = isset($_POST["ville"])? $_POST["ville"] : "";
	    $code_postal = isset($_POST["code_postal"])? $_POST["code_postal"] : "";
	    $pays = isset($_POST["pays"])? $_POST["pays"] : "";
	    $telephone =isset($_POST["telephone"])? $_POST["telephone"] : "";
	    $email = isset($_POST["email"])? $_POST["email"] : "";
	    ///infos CB
	    if(isset($_POST['type_carte'])){foreach ($_POST['type_carte'] as $type_carte){}}
	    $numero_carte = isset($_POST["numero_carte"])? $_POST["numero_carte"] : "";
	    $nom_proprio = isset($_POST["nom_proprio"])? $_POST["nom_proprio"] : "";
	    $expiration = isset($_POST["expiration"])? $_POST["expiration"] : "";
	    $crypto = isset($_POST["crypto"])? $_POST["crypto"] : "";

	    $mdp2 = isset($_POST["mdp2"])? $_POST["mdp2"] : "";
	    $email2 = isset($_POST["email2"])? $_POST["email2"] : "";

	    $erreur="";

	    $_SESSION["nom"]=$nom;
	    $_SESSION["prenom"]=$prenom;

	    ///mettre l'adresse complete
	    if(!($adresse2)) {$adresse2= "";}
    $expiration.= "-01";


    if (!empty($prenom)&&!empty($nom)&&!empty($pseudo)&&!empty($mdp)&&!empty($email)&&!empty($adresse)&&!empty($ville)&&!empty($code_postal)&&!empty($pays)&&!empty($telephone)&&!empty($numero_carte)&&!empty($nom_proprio)&&!empty($expiration)&&!empty($crypto)&&($mdp2 == $mdp)&&($email2 == $email)) {
        if ($conn)
        {
        	$verifmail=$conn->prepare("SELECT * FROM acheteur WHERE Mail = ?");
        	$verifmail->execute(array($email));
        	$mailexiste = $verifmail->rowCount();

        	$verifpseudo=$conn->prepare("SELECT * FROM acheteur WHERE Pseudo = ?");
        	$verifpseudo->execute(array($pseudo));
        	$pseudoexiste = $verifpseudo->rowCount();

        	if (($mailexiste == 0)&&($pseudoexiste == 0)) {
        		///on créé l'acheteur afin de créer son id 
            	$add = $conn->prepare("INSERT INTO acheteur (Nom, Prenom, Mdp, Pseudo, Adresse1, Adresse2, Ville, CodePostal, Pays, Num_tel, Mail, Numero_carte, Type_carte, Nom_carte, Date_expi, Code_secu) VALUES ('$nom','$prenom','$mdp','$pseudo','$adresse','$adresse2','$ville','$code_postal','$pays','$telephone','$email','$numero_carte','$type_carte','$nom_proprio','$expiration','$crypto')");
            	$add->execute([$nom,$prenom,$mdp,$pseudo,$adresse,$adresse2,$ville,$code_postal,$pays,$telephone,$email,$numero_carte,$type_carte,$nom_proprio,$expiration,$crypto]);
            	$last_id = $conn->lastInsertId();
            	$_SESSION["Id_user"]=$last_id;       
            	header('location: Connexion.php'); 
        	}
        	else{
        		if ($pseudoexiste != 0) {
        			$erreur .= "Le pseudo choisi existe deja. <br>";
        		}
        		if ($mailexiste != 0) {
        			$erreur .= "L'email choisi est deja utilisé. <br>";
        		}
        	}            
        }
    }
    else{

        if(!($prenom)) {$erreur .= "Le champ prenom est vide. <br>";}
        if(!($nom)) {$erreur .= "Le champ nom est vide. <br>";}
        if(!($pseudo)) {$erreur .= "Le champ pseudo est vide. <br>";}
        if(!($mdp)) {$erreur .= "Le champ mdp est vide. <br>";}
        if(!($email)) {$erreur .= "Le champ email est vide. <br>";}
        if(!($adresse)) {$erreur .= "Le champ adresse est vide. <br>";}
    	 if(!($ville)) {$erreur .= "Le champ ville est vide. <br>";}
        if(!($code_postal)) {$erreur .= "Le champ code_postal est vide. <br>";}
        if(!($pays)) {$erreur .= "Le champ pays est vide. <br>";}
        if(!($telephone)) {$erreur .= "Le champ telephone est vide. <br>";}
        if(!($type_carte)) {$erreur .= "Le champ type de carte est vide. <br>";}
        if(!($numero_carte)) {$erreur .= "Le champ numero de carte est vide. <br>";}
        if(!($nom_proprio)) {$erreur .= "Le champ nom du proprietaire est vide. <br>";}
        if(!($expiration)) {$erreur .= "Le champ expiration est vide. <br>";}
        if(!($crypto)) {$erreur .= "Le champ cryptogramme est vide. <br>";}
        if($mdp2 != $mdp){$erreur .= "Les mots de passe sont différents. <br>";}
        if($email2 != $email){$erreur .= "Les emails sont différents. <br>";}   
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
		
	                         <!--Logo-->
		<div>
		     <img src="ECEAmazon.jpg" alt="logo" width=400 height="100" />
		</div>
		
				<!--Centre le texte qui n'est pas dans un formulaire-->
			<div class="connexion_form">
				
			     <div class="container-fluid">
				
				      <div class="row">	
				        <legend>Creez votre compte Acheteur</legend>
				      </div>

					 
					<!--Formulaire fait 12 colones-->
				<form  action="" method="post" class="form-horizontal col-sm-12" class="needs-validation">
					<div class="col-sm-3"></div>
						<!--Premiere moitie de page (6 colones)-->
				   <div class="col-sm-6">
			          
					   <!--Prenom-->
				     <div class="row">
                      <div class="form-group">
                       <label for="prenom" class="col-sm-3 control-label">Prenom : </label>
                         <div class="col-sm-9">
                           <input name ="prenom" id="prenom" placeholder="Votre prenom" type="text" class="form-control" required>
                        </div>
                      </div>
		             </div>
					   
					   
					   <!--Nom-->
                   <div class="row">
                    <div class="form-group">
                     <label for="nom" class="col-sm-3 control-label">Nom : </label>
                       <div class="col-sm-9">
                        <input name ="nom" id="nom" placeholder="Votre nom" type="text" class="form-control" required>
                        </div>
                    </div>
		           </div>
					   
					   <!--Pseudo-->
				<div class="row">
                  <div class="form-group">
                   <label for="pseudo" class="col-sm-3 control-label">Pseudo : </label>
                     <div class="col-sm-9">
                      <input name ="pseudo" id="pseudo" placeholder="Votre Pseudo" type="text" class="form-control" required>
                     </div>
                  </div>
		        </div>
					   
					      <!--Mot de passe-->
					<div class="row">
                      <div class="form-group">
                         <label for="mdp" class="col-sm-3 control-label">Mot de passe : </label>
                      <div class="col-sm-9">
                        <input name ="mdp" id="mdp" placeholder="Votre mot de passe" type="password" class="form-control" required>
                     </div>
                     </div>
		            </div>

		            <div class="row">
                      <div class="form-group">
                         <label for="mdp2" class="col-sm-3 control-label">Mot de passe : </label>
                      <div class="col-sm-9">
                        <input name ="mdp2" id="mdp2" placeholder="Confirmez votre mot de passe" type="password" class="form-control" required>
                     </div>
                     </div>
		            </div>
					   
					   <!--Email-->
					
				<div class="row">
                  <div class="form-group">
                   <label for="email" class="col-sm-3 control-label">Email : </label>
                 <div class="col-sm-9">
                    <input name ="email" id="email" placeholder="Votre Email" type="email" class="form-control" required>
                 </div>
                 </div>
		        </div>

		        <div class="row">
                  <div class="form-group">
                   <label for="email2" class="col-sm-3 control-label">Email : </label>
                 <div class="col-sm-9">
                    <input name ="email2" id="email2" placeholder="Confirmez votre Email" type="email" class="form-control" required>
                 </div>
                 </div>
		        </div>
					   
					   <!--Adresse-->
					
					<div class="row">
                      <div class="form-group">
                        <label for="adresse" class="col-sm-3 control-label">Adresse : </label>
                      <div class="col-sm-9">
                        <input name ="adresse" id="adresse" placeholder="Votre adresse" type="text" class="form-control" required>
                      </div>
                     </div>
		            </div>
					   
					     <!--Adresse-->
					
					<div class="row">
                      <div class="form-group">
                        <label for="adresse2" class="col-sm-3 control-label">Adresse : </label>
                      <div class="col-sm-9">
                        <input name ="adresse2" id="adresse2" placeholder="Votre adresse" type="text" class="form-control">
                      </div>
                     </div>
		            </div>
					   
					   <!--Code postal-->
					
					<div class="row">
                      <div class="form-group">
                         <label for="code_postal" class="col-sm-3 control-label">Code postale : </label>
                        <div class="col-sm-9">
                         <input name ="code_postal" id="code_postal" placeholder="Votre codepostal" type="number" class="form-control" min="0" max="99999" required>
                        </div>
                      </div>
		             </div>
					   
					     <!--Ville-->
					
					<div class="row">
                      <div class="form-group">
                        <label for="ville" class="col-sm-3 control-label">Ville : </label>
                      <div class="col-sm-9">
                        <input name ="ville" id="ville" placeholder="Votre Ville" type="text" class="form-control" required>
                      </div>
                     </div>
		            </div>
					   
					   <!--Pays-->
					<div class="row">
                      <div class="form-group">
                      <label for="pays" class="col-sm-3 control-label">Pays : </label>
                        <div class="col-sm-9">
                           <input name ="pays" id="pays" placeholder="Votre pays" type="text" class="form-control" required>
                       </div>
                      </div>
		            </div>
					
					   <!--Telpehone-->
					<div class="row">
                      <div class="form-group">
                      <label for="telephone" class="col-sm-3 control-label">Telephone : </label>
                      <div class="col-sm-9">
                       <input name ="telephone" id="telephone" placeholder="Votre numero de telephone" type="tel" class="form-control" min="0100000000" max="0999999999" required>
                     </div>
                     </div>
		            </div>
					   
					   
					   <div class="col-sm-offset-2"><strong>Informations paiement</strong> <br> <br></div>
					   
					    <!--Type carte en menu deroulant-->
					<div class="row">
                         <div class="form-group">
                            <label for="type_carte" class="col-sm-3 control-label">Type de carte : </label>
                              <div class="col-sm-9">  
						        <select name="type_carte[]" class="form-control" required>
                                 <option>Visa</option>
                                 <option>MasterCard</option>
                                 <option>Mestro</option>
							     <option>American express</option>
                                </select> 
                             </div>
                          </div>
		            </div>

					    <!--Numero carte-->
					  <div class="row">
                        <div class="form-group">
                          <label for="numero_carte" class="col-sm-3 control-label">Numero de carte : </label>
                         <div class="col-sm-9">
                             <input name ="numero_carte" id="numero_carte" placeholder="Votre numero de carte bancaire" type="number" class="form-control" min="1" max="9999999999999999" required>
                         </div>
                        </div>
		            </div>
					   
					   
					    <!--Nom proprio carte-->
					  <div class="row">
                         <div class="form-group">
                            <label for="nom_proprio" class="col-sm-3 control-label">Nom : </label>
                              <div class="col-sm-9">
                                 <input name ="nom_proprio" id="nom_proprio" placeholder="Votre nom" type="text" class="form-control" required>
                              </div>
                         </div>
		              </div>
					   
					    <!--Date expiration-->
					   
					    <div class="row">
                          <div class="form-group">
                             <label for="date" class="col-sm-3 control-label">Date d'expiration: </label>
                               <div class="col-sm-9">
                                  <input type="month" name="expiration" id="expiration" class="form-control" required>
                               </div>
                           </div>
		                </div>
					   
					    <!--Cryptogramme-->
					   
					   <div class="row">
                           <div class="form-group">
                              <label for="Cryptogramme" class="col-sm-3 control-label">Cryptograme: </label>
                               <div class="col-sm-9">
                               <input name ="crypto" id="crypto" placeholder="Cryptogramme" type="number" class="form-control" min="0" max="999" required>
                              </div>
                           </div>
		              </div> 

	            <!--Bouton pour crer le contact-->
				<div class="col-sm-6"></div>
				<div class="col-sm-1 text-center">
					<button name="envoie_form_compte_acheteur" type="submit" class="pull-center btn btn-default">Creer mon compte</button> <br> <br>
				</div>
				<div class="col-sm-2">
												
				</div>
				<div class="col-sm-3" style="text-align: center;">
					<?php
         				if((isset($erreur))&&($erreur!="")) {
            			echo '<font color="red">'.$erreur."</font>";
         				}
         			?> 
     			</div>
                   
                
		            </form> 
		             				   
			</div>
					
					
					<!-- Deuxieme moitie de page (de la 6eme a la 12eme colone)-->
				
					<div class="col-sm-3">
						<a href="Connexion.php">
							<button type="submit" class="btn btn-primary btn-lg">Connexion
							</button> 
						</a>
					</div>
		</div>
	</body>
</html> 

