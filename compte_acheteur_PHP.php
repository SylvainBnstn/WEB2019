
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=eceamazon", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

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
if(isset($_POST['type_carte'])){
foreach ($_POST['type_carte'] as $type_carte){}}
$numero_carte = isset($_POST["numero_carte"])? $_POST["numero_carte"] : "";
$nom_proprio = isset($_POST["nom_proprio"])? $_POST["nom_proprio"] : "";
$expiration = isset($_POST["expiration"])? $_POST["expiration"] : "";
$crypto = isset($_POST["crypto"])? $_POST["crypto"] : "";

///mettre l'adresse complete
if(!($adresse2)) {$adresse2= "";}
$expiration.= "-01";
echo $expiration;

$erreur = ""; 

if (!empty($prenom)&&!empty($nom)&&!empty($pseudo)&&!empty($mdp)&&!empty($email)&&!empty($adresse)&&!empty($ville)&&!empty($code_postal)&&!empty($pays)&&!empty($telephone)&&!empty($numero_carte)&&!empty($nom_proprio)&&!empty($expiration)&&!empty($crypto)) {
    echo "<div>"; 
    echo "<br>";

    if ($conn)
    {

                ///on créé l'acheteur afin de créer son id 
        $add = $conn->prepare("INSERT INTO acheteur (Nom, Prenom, Mdp, Pseudo, Adresse1, Adresse2, Ville, CodePostal, Pays, Num_tel, Mail, Numero_carte, Type_carte, Nom_carte, Date_expi, Code_secu) VALUES ('$nom','$prenom','$mdp','$pseudo','$adresse','$adresse2','$ville','$code_postal','$pays','$telephone','$email','$numero_carte','$type_carte','$nom_proprio','$expiration','$crypto')");
        $add->execute([$nom,$prenom,$mdp,$pseudo,$adresse,$adresse2,$ville,$code_postal,$pays,$telephone,$email,$numero_carte,$type_carte,$nom_proprio,$expiration,$crypto]);
        $last_id = $conn->lastInsertId();
        echo "New record created successfully. Last inserted ID is: " . $last_id;        
        echo "</div>";     
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
    if(!($type_carte)) {$erreur .= "Le champ pays est vide. <br>";}
    if(!($numero_carte)) {$erreur .= "Le champ pays est vide. <br>";}
    if(!($nom_proprio)) {$erreur .= "Le champ pays est vide. <br>";}
    if(!($expiration)) {$erreur .= "Le champ pays est vide. <br>";}
    if(!($crypto)) {$erreur .= "Le champ pays est vide. <br>";}
    echo $erreur;    
}  

?>