
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

// Supprime la voiture
$query = "DELETE FROM voitures WHERE id = $id";
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

// Supprime l'image correspondante
$query2 = "DELETE FROM images WHERE id = $id";
$result2 = mysqli_query($conn, $query2);
if (!$result2) {
    die('Error executing query: ' . mysqli_error($conn));
}

header('Location: boutique_employe.php');

?>
