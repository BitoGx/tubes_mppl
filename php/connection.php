 <?php
  if(isset($_SESSION['Control']) || ($_SESSION['Loggedin'] == true))
  {
    $dbhost = "192.168.0.5";
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
    else
    {
      unset ($_SESSION["Control"]);
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?> 