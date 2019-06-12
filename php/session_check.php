<?php
  session_start();
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  require_once "session_check_dalam.php";
  if(!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false)
  {
    header("location: ../tubes_mppl/login.php");
    exit;
  }
?>