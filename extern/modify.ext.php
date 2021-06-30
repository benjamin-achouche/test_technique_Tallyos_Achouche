<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["modify-submit"])) {
  require "dbh.ext.php";

  $nom = $_POST["nom"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];

  $sql = "UPDATE ruches SET nom='" . $nom . "', latitude='" . $latitude . "', longitude='" . $longitude . "' WHERE id= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $_POST['modify-submit']);
  $res = $stmt->execute();

  if (!$res) {
    header("Location: ../ruches/ruches.php?error=sqlerror");
    exit();
  } else {
    header("Location: ../ruches/ruches.php");
    exit();
  }
}
