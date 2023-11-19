<?php
// Connexion à la base de données
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "projetgarage";
$conn = new mysqli($hostName, $userName, $password, $databaseName);

// Vérification de la connexion
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Récupération de l'ID de l'avis à partir de l'URL
$id = $_GET['id'];

// Requête pour supprimer l'avis
$sql = "DELETE FROM avis WHERE id=$id";

// Exécution de la requête
if ($conn->query($sql) === TRUE) {
    header('Location: site_employe.php');
} else {
 echo "Error deleting record: " . $conn->error;
}

// Fermeture de la connexion
$conn->close();
?>