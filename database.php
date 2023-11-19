<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetgarage";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

session_start();
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$commentaire = $_POST['commentaire'];
$note = $_POST['note'];

// Préparer une requête SQL
$sql = "INSERT INTO Avis (nom, commentaire, note) VALUES ('$nom', '$commentaire', '$note')";

if (isset($_SESSION['type_utilisateur'])) {
    echo "Le rôle de l'utilisateur est : " . $_SESSION['type_utilisateur'];
 } else {
    echo "Le rôle de l'utilisateur n'est pas défini";
 }
 
// Exécuter la requête
if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
  } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
  }
  

// Fermer la connexion
$conn->close();
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
?>

