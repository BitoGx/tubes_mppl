<?php
  session_start();
  echo $_SESSION['Loggedin'];
  $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  echo $url;
?>