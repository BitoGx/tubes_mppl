<?php
  session_start();
  $level = $_SESSION['Level'];
  unset($_SESSION['IdBarang']);
  if(!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false)
  {
    header("location: ../tubes_mppl/login.php");
    exit;
  }
?>