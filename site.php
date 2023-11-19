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
      <img src="/photo/Capture d'écran 2023-07-18 104210.png" alt="logo">
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
   } else {
   ?>
     <form method="post" action="connexion.php">
       <input type="submit" value="Connexion" style="background-color: black; display : flex; color: white; ">
     </form>
   <?php
   }
   ?>
    </div>
    <div class="links">
      <ul>
          <li><a href="./Boutique.php">Boutique</a></li>
          <li><a href="./service.php">Service</a></li>
          <li><a href="./Contact.php">Contact</a></li>
      </ul>
    </div>
    </nav>
  </header>
    <main>
      <div class="titre">
        <h1>Garage V.Parrot</h1>
        <p>(entretien véhicule, vente de véhicule d'occasions)</p>
      </div>
      <div class="proposition">
          <div class="vehicule">
            <p>Bienvenue chez Garage V. Parrot - Votre destination de confiance pour l'achat de véhicules d'occasion de qualité à Toulouse ! Forts de notre expertise et de nos 15 années d'expérience, nous proposons une sélection minutieuse de véhicules d'occasion qui répondent aux plus hautes normes de qualité et de fiabilité.</p>
            <a href="./Boutique.php">Découvrir</a>
          </div>
          <div class="service">
            <p>Explorez nos services. Avec une équipe d'experts passionnés par leur métier, nous offrons une gamme complète de services de réparation et d'entretien pour garantir la performance et la longévité de votre véhicule.</p><br>
            <a href="./service.php">Découvrir</a>
          </div>
      </div>
      <div class="formAvis">
        <h2>Laissez un témoignage</h2>
        <form method="post" action="database.php">
          <label for="nom">Nom:</label>
          <input type="text" id="nom" name="nom" required>
          
          <label for="commentaire">Commentaire:</label>
          <textarea id="commentaire" name="commentaire" required></textarea>
          
          <label for="note">Note:</label>
          <div class="rating">
<input type="number" id="note" name="note" min="1" max="5">

        </div>
          
          <button type="submit" name="submit">Envoyer</button>
        </form>
      </div>
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

// Requête pour récupérer les avis approuvés
$query = "SELECT * FROM avis_approuve";
$result = mysqli_query($conn, $query);
?>

<div class="message-container">
<?php
// Affichage des avis approuvés
if (mysqli_num_rows($result) > 0) {
 while($data = mysqli_fetch_assoc($result)) {
 ?>
 <div class="message-bubble">
 <p><strong>Nom:</strong></p>
  <p><?php echo $data['nom']; ?></p>
  <p><strong>Commentaire:</strong></p>
  <p><?php echo $data['commentaire']; ?></p>
  <p><strong>Note:</strong></p>
  <p><?php echo $data['note']; ?></p>
 </div>
 <?php
 }
} else {
 echo "<p>No data found</p>";
}
?>
</div>

<?php
// Fermeture de la connexion
$conn->close();
?>
</main>
    <footer>
      <div class="contact">
        <p>Contact :</p>
        <ul>
          <li><a href="Garage.parrot@gmail.com">Garage.parrot@gmail.com</a></li>
          <li>tél : 06 06 06 06 06</li>
        </ul>
      </div>
      <div class="Horaires">
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
</body>
<style>
  .message-container {
  margin: 0;
  padding: 0;
  margin-top: 50px;
  justify-content: center;
  display: flex;
  align-items: center;
}

.message-bubble {
  white-space: nowrap;
  font-size: 1.3em;
  border: 2px solid black;
  border-radius: 15px;
  padding: 8px;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-left: 10px;
}

</style>
<script src="script.js"></script>
</html>