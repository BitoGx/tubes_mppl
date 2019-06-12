<?php
  session_start();
  if(isset($_POST['username']))
  {
    echo "true";
  }
  else
  {
    echo "false";
  }
  echo $_SESSION['Control'];
?>