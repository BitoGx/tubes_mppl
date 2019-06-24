<?php
  session_start();
  if((!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false) or ($_SESSION['Status'] == 0))
  {
    header("location: ../tubes_mppl/login.php");
    exit;
  }
?>