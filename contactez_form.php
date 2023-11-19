<?php
// Remplacez ces valeurs par vos propres informations de connexion
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

// Récupérer les données du formulaire
$nom = $_POST['name'];
$prenom = $_POST['surname'];
$email = $_POST['email'];
$numero_telephone = $_POST['phone'];
$message = $_POST['message'];

// Créer une requête SQL pour insérer les données dans la table
$sql = "INSERT INTO contact (nom, prenom, email, numero_telephone, message) VALUES ('$nom', '$prenom', '$email', '$numero_telephone', '$message')";

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
