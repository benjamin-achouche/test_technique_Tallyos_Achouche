<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajouter-ruche-submit"])) {
  require 'dbh.ext.php';


  $nom = $_POST["nom"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];

  if (!preg_match("/[a-zA-Z0-9]/", $nom)) {
    header("Location: ../ruches/ruches.php?error=invalidname");
    exit();
  } else {
    $sql = "SELECT nom FROM ruches WHERE nom='" . $nom . "';";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
      header("Location: ../ruches/ruches.php?error=sqlerror");
      exit();
    } else {
      $resultCheck = mysqli_num_rows($res);
      if ($resultCheck > 0) {
        header("Location: ../ruches/ruches.php?error=nametaken");
        exit();
      } else {
        $sql = "INSERT INTO ruches(nom,latitude,longitude) VALUES ('" . $nom . "','" . $latitude . "','" . $longitude . "');";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
          header("Location: ../ruches/ruches.php?error=sqlerror");
          exit();
        } else {
          header("Location: ../ruches/ruches.php?ajout=success");
          exit();
        }
      }
    }
  }

  mysqli_close($conn);
} else {
  header("Location: ../ruches/ruches.php");
  exit();
}
