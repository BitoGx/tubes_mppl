<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if((isset($_POST['IdBarang'])) and (isset($_POST['IdPenyewaan']))  )
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST
    $IdBarang = $_POST['IdBarang'];
    $IdPenyewaan = $_POST['IdPenyewaan'];
    $_SESSION['IdPenyewaan'] = $IdPenyewaan;
    $Jumlah = $_POST['Jumlah'];
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
    
    //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
    $sql= "update detail_penyewaan set JumlahBarang = $Jumlah where IdBarang = $IdBarang and IdPenyewaan=$IdPenyewaan";
      
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    //Mengecek apakah terjadi perubahan di dalam database atau tidak
    $hasil=mysqli_affected_rows($conn);
      
    if($hasil)
    {
      header("location: ../penyewaan.php");
    }
    else
    {
      echo "Data Gagal Di Ubah";
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>