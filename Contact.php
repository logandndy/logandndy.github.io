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
     <a href="./site.php"><img src="/photo/Capture d'écran 2023-07-18 104210.png" alt="logo"></a> 
    </div>
    <nav>
    <div class="inputs">
        <?php
   session_start();
   if (isset($_SESSION["utilisateur"])) {
   ?>
     <form method="post" action="logout.php">
       <input type="submit" value="Déconnexion" style="background-color: black; display : flex; color: white; " >
     </form>
   <?php
   } 
   ?>
    </div>
    <div class="links">
      <ul>
          <li><a href="./site.php">Accueil</a></li>
          <li><a href="./Boutique.php">Boutique</a></li>
          <li><a href="./service.php">Service</a></li>
          <li><a href="./Contact.php">Contact</a></li>
      </ul>
    </div>
    </nav>
    <main>
        <div class="contactezNous">
            <h2>Contactez-nous</h2>
        </div>
        <div class="formulaire">
          <form  action="contactez_form.php" method="POST">
            <div>
              <label for="name">Nom :</label>
              <input type="text" id="name" name="name" placeholder="Nom" required>
            </div>
            <div>
              <label for="surname">Prénom :</label>
              <input type="text" id="surname" name="surname" placeholder="Prénom" required>
            </div>
            <div>
              <label for="email">Email :</label>
              <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div>
              <label for="phone">Numéro de téléphone :</label>
              <input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" required>
            </div>
            <div>
              <label for="message">Message :</label>
              <textarea style="width: 700px;height: 200px;" id="message" name="message" rows="4" placeholder="Saisissez votre commentaire" required></textarea>
            </div>
            <div>
              <input type="submit" value="Envoyer">
            </div>
          </form>
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
  $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
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