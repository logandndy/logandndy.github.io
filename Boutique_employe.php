<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
          <a href="./site.php"><img src="/photo/Capture d'écran 2023-07-18 104210.png" alt="logo"></a>
        </div>
        <nav>
        <div class="inputs">
          <ul>
          <?php
   session_start();
   if (isset($_SESSION["utilisateur"])) {
   ?>
     <form method="post" action="logout.php">
       <input type="submit" value="Déconnexion" style="background-color: black; color: white;">
     </form>
   <?php
   }
   ?>
        </div>
        <div class="links">
          <ul>
              <li><a href="./site_employe.php">Accueil</a></li>
              <li><a href="./Boutique_employe.php">Boutique</a></li>
              <li><a href="./service_employe.php">Service</a></li>
              <li><a href="./Contact_employe.php">Contact</a></li>
          </ul>
        </div>
       </nav>
    </header>
        <main class="mainBoutique">
          <div class="neufoccas">
            
          </div>
         
          <div class="vente_employe" style="display: flex; flex-direction: column; padding-bottom: 50px;">

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

    $query = "SELECT * FROM voitures";
$result = mysqli_query($conn, $query);

$query2 = "SELECT * FROM images";
$result2 = mysqli_query($conn, $query2);
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>photo</th>
    <th>ETAT  </th>
    <th>Modele</th>
    <th>Annee</th>
    <th>km</th>
    <th>prix</th>
  </tr>
<?php
if (mysqli_num_rows($result) > 0) {
  while($data = mysqli_fetch_assoc($result)) {
    $image = '';
    foreach($result2 as $img) {
      if ($data['id'] == $img['id']) {
        $image = $img['file'];
      }
    }
?>
<tr>
  <td><img src="./upload/<?php echo $image; ?>" alt="Image" width="100" height="100"></td>
  <td><?php echo $data['ETAT']; ?> </td>
  <td><?php echo $data['NOM']; ?> </td>
  <td><?php echo $data['mise_circulation']; ?> </td>
  <td><?php echo $data['km']; ?> </td>
  <td><?php echo $data['prix']; ?> </td>
  <td><a href="delete.php?id=<?php echo $data['id']; ?>">Supprimer</a></td>
</tr>
<?php
  }
} else { ?>
  <tr>
   <td colspan="6">No data found</td>
  </tr>
<?php } ?>
</table>

            </div>
        </div>
        <form action="./process_voiture.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
   <label for="etat">Etat:</label><br>
   <input type="text" id="etat" name="etat"><br>
   <label for="nom">Nom:</label><br>
   <input type="text" id="nom" name="nom"><br>
   <label for="mise_circulation">Mise en circulation:</label><br>
   <input type="date" id="mise_circulation" name="mise_circulation"><br>
   <label for="km">Kilomètres:</label><br>
   <input type="number" id="km" name="km"><br>
   <label for="prix">Prix:</label><br>
   <input type="number" id="prix" name="prix"><br>
   <input type="submit" value="Submit">
</form>
<form action="upload.php" method="post" enctype="multipart/form-data" style="display: flex; align-items: center; justify-content: center; padding-top:35px;">
        Selectionner une image
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
    </form>
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
        <script src="script.js"></script>
</body>
</html>