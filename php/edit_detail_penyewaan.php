<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if((isset($_POST['IdBarang'])) and (isset($_POST['IdPenyewaan']))  )
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST
    $IdBarang    = $_POST['IdBarang'];
    $IdPenyewaan = $_POST['IdPenyewaan'];
    $Action      = $_POST['Action'];
    $_SESSION['IdPenyewaan'] = $IdPenyewaan;
    $Jumlah = $_POST['Jumlah'];
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
    
    switch($Action)
      {
         case "Atur":
          //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang untuk mengatu
          $sql= "update detail_penyewaan set JumlahBarang = $Jumlah where IdBarang = $IdBarang and IdPenyewaan=$IdPenyewaan";
        break;
        case "Keluar":
          //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang untuk mengatu
          $sql= "update detail_penyewaan set BarangKeluar = $Jumlah where IdBarang = $IdBarang and IdPenyewaan=$IdPenyewaan";
        break;
        case "Masuk":
          //header("location: ../index.php");
        break;
      }
    
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    //Mengecek apakah terjadi perubahan di dalam database atau tidak
    $hasil=mysqli_affected_rows($conn);
      
    if($hasil)
    {
      switch($Action)
      {
         case "Atur":
          header("location: ../penyewaan.php");
          exit;
        break;
        case "Keluar":
          header("location: edit_detail_penyewaan.php");
          exit;
        break;
        case "Masuk":
          //header("location: ../index.php");
          exit;
        break;
      }
      
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