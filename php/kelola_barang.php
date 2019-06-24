<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if(isset($_SESSION['IdBarang']))
  {
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
    
    //Mengecek apakah terjadi perubahan di dalam database atau tidak
    $hasil=mysqli_affected_rows($conn);
    
    $Level = $_SESSION['Level'];  
    if($hasil)
    {
      header("location: ../detail_barang_utama.php");
    }
    else
    {
      echo "Data Gagal Di Ubah";
      switch($Level)
      {
        case 1:
          header("location: ../index_teknisi.php");
        break;
        case 2:
          header("location: ../index_penanggung.php");
        break;
        case 3:
          header("location: ../detail_barang_utama.php");
        break;
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>