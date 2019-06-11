<?php
  session_start();
  echo $_SESSION['Loggedin'];
  //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  //echo $url;
  //$_SESSION['IdBarang'] = "LOL";
  echo $_POST['IdBarang'];
  if(isset($_POST['IdBarang']))
  {
    echo "True";
  }
  else
  {
    echo "False";
  }
?>