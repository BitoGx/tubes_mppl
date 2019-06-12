<?php
  if(!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false)
  {
    header("location: ../login.php");
    exit;
  }
?>