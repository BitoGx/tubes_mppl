<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Menyimpan Variabel yang di kirim menggunakan method POST
  $Total = $_POST['Total'];
  $Baik = $_POST['Baik'];
  $Maintenance = $_POST['Maintenance'];
  $Rusak = $_POST['Rusak'];
  $IdBarang = $_SESSION['IdBarang'];
     
  //Memilih database
  mysqli_select_db($conn,"dellaria");
   
  //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
  $sql= "update barang as b,status_barang as sb set b.Jumlah = $Total,sb.Baik = $Baik,sb.Maintenance = $Maintenance,sb.Rusak = $Rusak where b.IdBarang = sb.IdBarang and b.IdBarang=$IdBarang";
      
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