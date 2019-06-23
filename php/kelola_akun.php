<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if(isset($_SESSION['IdUser']))
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST
    $Username = $_POST['Username'];
    $Username = strtolower($Username);
    $Nama     = $_POST['Nama'];
    $Nama     = ucwords($Nama);
    $Level    = $_POST['Level'];
    $Status   = $_POST['Status'];
    $IdUser   = $_SESSION['IdUser'];
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
    
    //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
    $sql= "update user set Username = '$Username', Nama = '$Nama', Level = $Level, Status = '$Status' where IdUser = $IdUser";
      
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    //Mengecek apakah terjadi perubahan di dalam database atau tidak
    $hasil=mysqli_affected_rows($conn);
    
    if($hasil)
    {
      unset($_SESSION['IdUser']);
      header("location: ../kelola_akun_semua_utama.php");
      exit;
    }
    else
    {
      echo "Data Gagal Di Ubah";
      header("location: ../kelola_akun_semua_utama.php");
      exit;
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>