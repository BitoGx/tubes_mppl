 <?php
  $dbhost = "192.168.100.7";
  $dbname = "dellaria";
  $dbuser = "admin";
  $dbpass = "123adm123";

  // Buat Koneksi
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check Koneksi Nerhasil atau Tidak
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
?> 