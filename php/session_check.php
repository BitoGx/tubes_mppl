<?php
  session_start();
  $level = $_SESSION['Level'];
  if(!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false)
  {
    header("location: ../tubes_mppl/login.php");
    exit;
  }
?>