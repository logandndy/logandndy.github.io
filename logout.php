<?php
// Démarrer la session
session_start();

// Détruire seulement la variable de session liée à l'état de connexion de l'utilisateur
unset($_SESSION['avis']);

session_destroy();

// Rediriger vers la page de connexion
header("Location: site.php");
exit();
?>
