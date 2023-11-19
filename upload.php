<?php
  // Connexion à la base de données
  $host='localhost';
  $username='root';
  $password='';
  $dbname = "projetgarage";
  $conn=mysqli_connect($host,$username,$password,"$dbname");
  if(!$conn)
      {
        die('Could not Connect MySql Server:' .mysql_error());
      }

  // Vérification et traitement du fichier téléchargé
  $extensions = ['jpg', 'png', 'jpeg', 'gif'];
  $maxSize = 400000; // Taille maximale en bytes
  if (!is_dir('./upload')) {
    mkdir('./upload', 0777, true);
}

  if (isset($_FILES['file'])) {
      $name = $_FILES['file']['name'];
      $tmpName = $_FILES['file']['tmp_name'];
      $size = $_FILES['file']['size'];
      $extension = pathinfo($name, PATHINFO_EXTENSION);
      $type = $_FILES['file']['type'];

      if(in_array($extension, $extensions) && $size <= $maxSize){
          $uniqueName = uniqid('', true);
          $file = $uniqueName.".".$extension;
          move_uploaded_file($tmpName, './upload/'.$file);
      }
      else{
          echo "Mauvaise extension ou taille trop grande";
      }

      // Insertion du nom du fichier, du type et de la taille dans la base de données
      $sql = "INSERT INTO images(file, type, size) VALUES ('$file', '$type', '$size')";

      if (mysqli_query($conn, $sql)) {
          echo "Image uploaded successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  } else {
      echo "No file uploaded";
  }

  mysqli_close($conn);
  header('Location: Boutique_employe.php');
?>
