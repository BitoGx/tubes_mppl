<?php
  session_start();
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  require_once "session_check_dalam.php";
  session_destroy();
  header("location: ../login.php");
?>