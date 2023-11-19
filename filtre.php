<?php
$servername='localhost';
$username='root';
$password='';
$dbname = "projetgarage";
$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn)
{
    die('Could not Connect MySql Server:' .mysqli_connect_error());
}

// Récupérez les données du formulaire
$minPrice = isset($_POST['minPrice']) ? filter_var($_POST['minPrice'], FILTER_SANITIZE_NUMBER_INT) : null;
$maxPrice = isset($_POST['maxPrice']) ? filter_var($_POST['maxPrice'], FILTER_SANITIZE_NUMBER_INT) : null;
$minYear = isset($_POST['minYear']) ? filter_var($_POST['minYear'], FILTER_SANITIZE_NUMBER_INT) : null;
$maxKm = isset($_POST['maxKm']) ? filter_var($_POST['maxKm'], FILTER_SANITIZE_NUMBER_INT) : null;

// Créez la requête SQL
$query = "SELECT voitures.*, images.file FROM voitures INNER JOIN images ON voitures.id = images.id WHERE 1=1";
if ($minPrice !== null) {
    $query .= " AND voitures.prix >= $minPrice";
}
if ($maxPrice !== null) {
    $query .= " AND voitures.prix <= $maxPrice";
}
if ($minYear !== null) {
    $query .= " AND voitures.mise_circulation >= $minYear";
}
if ($maxKm !== null) {
    $query .= " AND voitures.km <= $maxKm";
}

$result = mysqli_query($conn, $query);

// Générez le tableau de résultats
$cars = array();
while($row = $result->fetch_assoc()) {
  $cars[] = $row;
}

// Renvoyez le tableau de résultats en tant que réponse JSON
echo json_encode($cars);

$conn->close();
?>
