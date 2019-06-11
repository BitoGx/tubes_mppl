<?php
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Session Start
  session_start();
  
  //Menyimpan Variabel yang di kirim menggunakan method POST
  $Total = $_POST['Total'];
  $Baik = $_POST['Baik'];
  $Maintanance = $_POST['Maintanance'];
  $Rusak = $_POST['Rusak'];
  $IdBarang = $_SESSION['IdBarang'];
     
  //Memilih database
  mysqli_select_db($conn,"dellaria");
   
  //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
  $sql= "update barang as b,status_barang as sb set b.Jumlah = $Total,sb.Baik = $Baik,sb.Maintanance = $Maintanance,sb.Rusak = $Rusak where b.IdBarang = sb.IdBarang and b.IdBarang=$IdBarang";
      
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
      
  if($hasil == 1)
  {
    $Level = $_SESSION['Level'];
    switch($Level)
    {
      case 1:
        header("location: ../index_teknisi.php");
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
    echo "Data Gagal Di Ubah";
  }
?>