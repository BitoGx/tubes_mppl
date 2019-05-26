 <?php
  $dbhost = "192.168.100.7";
  $dbname = "dellaria";
  $dbuser = "admin";
  $dbpass = "123adm123";

  // Create connection
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check connection
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
?> 