<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetgarage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$etat = $_POST['etat'];
$nom = $_POST['nom'];
$mise_circulation = $_POST['mise_circulation'];
$km = $_POST['km'];
$prix = $_POST['prix'];

$sql = "INSERT INTO voitures (etat, nom, mise_circulation, km, prix)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $etat, $nom, $mise_circulation, $km, $prix);

if ($stmt->execute()) {
 echo "Voiture ajoutée avec succès!";
} else {
 echo "Une erreur s'est produite lors de l'ajout de la voiture.";
}

$stmt->close();
$conn->close();
header('Location: Boutique_employe.php');
?>
