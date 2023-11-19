<?php
$host='localhost';
$username='root';
$password='';
$dbname = "projetgarage";
$conn=mysqli_connect($host,$username,$password,"$dbname");
if(!$conn)
{
    die('Could not Connect MySql Server:' .mysql_error());
}

$id = $_GET['id'];

// Récupère l'avis de la table avis
$query = "SELECT * FROM avis WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Insère l'avis dans la table avis_approuve
$query2 = "INSERT INTO avis_approuve (id, nom, commentaire, note) VALUES ('$data[id]', '$data[nom]', '$data[commentaire]', '$data[note]')";
$result2 = mysqli_query($conn, $query2);
if (!$result2) {
    die('Error executing query: ' . mysqli_error($conn));
}

// Supprime l'avis de la table avis
$query3 = "DELETE FROM avis WHERE id = $id";
$result3 = mysqli_query($conn, $query3);
if (!$result3) {
    die('Error executing query: ' . mysqli_error($conn));
}

header('Location: site_employe.php');
?>
