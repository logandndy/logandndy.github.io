<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Garage V.Parrot</title>
  <link rel="stylesheet" href="style.css">
  <style>
        .container {
            display: flex;
            justify-content: space-between;
        }
        .form {
            width: 45%;
        }
        table {
            width: 45%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
    </style>
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
      <div style="display:flex; justify-content: center; margin-top:25px;"><h2 style="font-size: 4em;margin-bottom:50px">Administration</h2></div>

    <div style="display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;">
    
 
    <div style="display: flex;
    flex-direction: column;
    align-items: center;">
  
   
   <?php
    $host = 'localhost';
    $db = 'projetgarage';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
      PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    if (isset($_POST['add_admin'])) {
       $email = $_POST['email'];
       $password = $_POST['mot_de_passe'];
       $type_utilisateur = 'administrateur';
       $stmt = $pdo->prepare('INSERT INTO utilisateurs (email, mot_de_passe, type_utilisateur) VALUES (?, ?, ?)');
       $stmt->execute([$email, $password, $type_utilisateur]);
    }

    if (isset($_GET['delete_admin'])) {
       $email = $_GET['delete_admin'];
       $stmt = $pdo->prepare('DELETE FROM utilisateurs WHERE email = ? AND type_utilisateur = "administrateur"');
       $stmt->execute([$email]);
    }

    if (isset($_POST['add_user'])) {
       $email = $_POST['email'];
       $password = $_POST['mot_de_passe'];
       $type_utilisateur = 'employe';
       $stmt = $pdo->prepare('INSERT INTO utilisateurs (email, mot_de_passe, type_utilisateur) VALUES (?, ?, ?)');
       $stmt->execute([$email, $password, $type_utilisateur]);
    }

    if (isset($_GET['delete_user'])) {
       $email = $_GET['delete_user'];
       $stmt = $pdo->prepare('DELETE FROM utilisateurs WHERE email = ?');
       $stmt->execute([$email]);
    }
    ?>

    <h3 style="margin-bottom: 20px;">Ajouter un administrateur</h3>
    <form  style="display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;"method="post">
        <label for="email">email:</label><br>
        <input style="margin-bottom: 20px;" type="text" id="email" name="email"><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input style="margin-bottom: 20px;" type="password" id="mot_de_passe" name="mot_de_passe"><br>
        <input style="margin-bottom: 20px;" type="submit" name="add_admin" value="Ajouter un administrateur">
    </form>

    <h3>Administrateurs</h3>
    <?php
    $stmt = $pdo->query('SELECT email FROM utilisateurs WHERE type_utilisateur = "administrateur"');
    while ($row = $stmt->fetch()) {
        echo '<a href="adminside.php?delete_admin=' . $row['email'] . '">' . $row['email'] . '</a><br>';
    }?>
</div>
<div style="display: flex;
    flex-direction: column;
    align-items: center;">
    
    <h3 style="margin-bottom: 20px;">Ajouter un employé</h3>
    <form style="display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;" method="post">
        <label for="email">email:</label><br>
        <input style="margin-bottom: 20px;" type="text" id="email" name="email"><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input style="margin-bottom: 20px;" type="password" id="mot_de_passe" name="mot_de_passe"><br>
        <input style="margin-bottom: 20px;" type="submit" name="add_user" value="Ajouter un employé">
    </form>

    <h3>Employé</h3>
    <?php
    $stmt = $pdo->query('SELECT email FROM utilisateurs WHERE type_utilisateur = "employe"');
while ($row = $stmt->fetch()) {
    echo '<a href="adminside.php?delete_user=' . $row['email'] . '">' . $row['email'] . '</a><br>';
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