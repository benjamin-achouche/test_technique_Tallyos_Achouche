<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete-submit"])) {
  require "dbh.ext.php";

  $sql = "DELETE FROM ruches WHERE nom= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $_POST['delete-submit']);
  $res = $stmt->execute();

  if (!$res) {
    header("Location: ../ruches/ruches.php?error=sqlerror");
    exit();
  } else {
    header("Location: ../ruches/ruches.php");
    exit();
  }
}
