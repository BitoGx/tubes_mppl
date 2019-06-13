<?php
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if(isset($_SESSION['Id']))
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST dan mengambil Id User dari SESSION
    $id = $_SESSION['Id'];
    $pass = $_POST['passbaru1'];
    $passlama = $_POST['passlama'];
    $pass = sha1($pass);
    $passlama = sha1($passlama);
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
   
    //Mempersiapkan Command Query  untuk mengupdate Password user
    $sql= "update user set Password ='$pass' where IdUser=$id and Password='$passlama'";
      
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    //Mengecek apakah terjadi perubahan di dalam database atau tidak
    $hasil=mysqli_affected_rows($conn);
    
    if($hasil)
    {
      
      $Level = $_SESSION['Level'];
      switch($Level)
      {
        case 1:
          header("location: ../kelola_akun_teknisi.php");
        break;
        case 2:
          header("location: ../index_penanggung.php");
        break;
        case 3:
          header("location: ../index.php");
        break;
      }
    }
    else
    {
      echo "Password lama yang anda masukkan salah";
      header("Refresh: 10; http://localhost/tubes_mppl/kelola_akun_teknisi.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>