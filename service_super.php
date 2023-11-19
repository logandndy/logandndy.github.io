<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Garage V.Parrot</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo">
     <a href="./site_super.php"><img src="/photo/Capture d'écran 2023-07-18 104210.png" alt="logo"></a> 
    </div>
    <nav>
    <div class="inputs">
          <?php
   session_start();
   if (isset($_SESSION["utilisateur"])) {
   ?>
     <form method="post" action="logout.php">
       <input type="submit" value="Déconnexion" style="background-color: black; display : flex; color: white;">
     </form>
   <?php
   }
   ?>
   </div>
   <div class="links">
        <ul>
          <li><a href="./Boutique_super.php">Boutique</a></li>
          <li><a href="./service_super.php">Service</a></li>
          <li><a href="./Contact_super.php">Contact</a></li>
          <li><a href="./adminside_super.php">Administration</a></li>
        </ul>
   </div>
    </nav>
    <main>
        <div class="titreService">
            <p>Prenez rendez-vous chez nous !</p>
        </div>
        <div class="servPlan">
            <div class="mesServices">
            <?php
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=projetgarage;charset=utf8', 'root', '');

// Récupération des services de la base de données
$services = $db->query('SELECT * FROM services')->fetchAll(PDO::FETCH_ASSOC);

// Affichage des services
foreach ($services as $service) {
  echo '<p>' . $service['name'] . '</p>';
}

// Gestion des services
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $action = $_POST['action'];

  if ($action === 'add') {
      $db->exec("INSERT INTO services (name) VALUES ('$name')");
  } elseif ($action === 'delete') {
      $db->exec("DELETE FROM services WHERE name = '$name'");
  }
}
?>

<!-- Formulaire pour ajouter un service -->
<form method="post">
  <input type="text" name="name" placeholder="Nom du service">
  <input type="hidden" name="action" value="add">
  <button type="submit">Ajouter un service</button>
</form>

<!-- Formulaire pour supprimer un service -->
<form method="post">
  <input type="text" name="name" placeholder="Nom du service à supprimer">
  <input type="hidden" name="action" value="delete">
  <button type="submit">Supprimer un service</button>
</form>

            </div>
            <div class="horaire">
            <?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=projetgarage", 'root', '');
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

$sql = 'SELECT jour_semaine, heure_matin, heure_matin2, heure_aprem, heure_aprem2 FROM horaires ORDER BY FIELD(jour_semaine, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche")';
$stmt = $pdo->query($sql);

// Vérifiez si la requête a réussi
if ($stmt) {
  // Récupérez les données et affichez-les (ou utilisez-les comme nécessaire)
  echo "<p>Horaire d'ouverture : <br>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $jour_semaine = $row['jour_semaine'];
      $heure_matin = $row['heure_matin'];
      $heure_matin2 = $row['heure_matin2'];
      $heure_aprem = $row['heure_aprem'];
      $heure_aprem2 = $row['heure_aprem2'];

      // Afficher les données
      echo $jour_semaine . " : " . $heure_matin . " - " . $heure_matin2 . " / " . $heure_aprem . " - " . $heure_aprem2 . "<br>";

     
  }
  echo "</p>";
} else {
  echo "Erreur lors de la récupération des données.";
}

?>
            </div>
        </div>

    </main>
    <footer>
      <div class="contact">
        <p>Contact :</p>
        <ul>
          <li><a href="Garage.parrot@gmail.com">Garage.parrot@gmail.com</a></li>
          <li>tél : 06 06 06 06 06</li>
        </ul>
      </div>
      <div>
        <?php
      try {
  $pdo = new PDO("mysql:host=localhost;dbname=projetgarage", 'root', '');
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

$sql = 'SELECT jour_semaine, heure_matin, heure_matin2, heure_aprem, heure_aprem2 FROM horaires ORDER BY FIELD(jour_semaine, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche")';
$stmt = $pdo->query($sql);

// Vérifiez si la requête a réussi
if ($stmt) {
  // Récupérez les données et affichez-les (ou utilisez-les comme nécessaire)
  echo "<p>Horaire d'ouverture : <br>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $jour_semaine = $row['jour_semaine'];
      $heure_matin = $row['heure_matin'];
      $heure_matin2 = $row['heure_matin2'];
      $heure_aprem = $row['heure_aprem'];
      $heure_aprem2 = $row['heure_aprem2'];

      // Afficher les données
      echo $jour_semaine . " : " . $heure_matin . " - " . $heure_matin2 . " / " . $heure_aprem . " - " . $heure_aprem2 . "<br>";

      
  }
  echo "</p>";
} else {
  echo "Erreur lors de la récupération des données.";
}

?>


      </div>
    </footer>
  </header>
</body>
</html>