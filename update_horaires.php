<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projetgarage", 'root', '');
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$jour_semaine = $_POST['jour_semaine'];
$heure_matin = $_POST['heure_matin'];
$heure_matin2 = $_POST['heure_matin2'];
$heure_aprem = $_POST['heure_aprem'];
$heure_aprem2 = $_POST['heure_aprem2'];

$sql = 'UPDATE horaires SET heure_matin = :heure_matin, heure_matin2 = :heure_matin2, heure_aprem = :heure_aprem, heure_aprem2 = :heure_aprem2 WHERE jour_semaine = :jour_semaine';
$stmt = $pdo->prepare($sql);
$stmt->execute(['heure_matin' => $heure_matin, 'heure_matin2' => $heure_matin2, 'heure_aprem' => $heure_aprem, 'heure_aprem2' => $heure_aprem2, 'jour_semaine' => $jour_semaine]);

header('Location: site_admin.php'); // Redirigez l'utilisateur vers la page d'administration
?>

