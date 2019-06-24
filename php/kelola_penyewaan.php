<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  $Level = $_SESSION['Level'];
  
  if(isset($_SESSION['IdPenyewaan']))
  {
    $WaktuSewa = $_POST['WaktuSewa'];
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
    
    //Mempersiapkan Command Query  untuk mengecek apakah IdPenyewaan yang ditambahkan sudah ada atau belum
    $sql="select * from penyewaan where WaktuSewa='$WaktuSewa'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    $row=mysqli_fetch_row($hasil);

    if($row)  
    {
      echo "Maaf tanggal sewa yang dipilih tidak tersedia";
      switch($Level)
      {
        case 2:
          header("Refresh: 5; ../kelola_sewa.php");
        break;
        case 3:
          header("Refresh: 5; ../daftar_penyewaan_utama.php");
        break;
      }
    }
    else
    {  
      //Menyimpan Variabel yang di kirim menggunakan method POST
      $IdPenyewaan = $_SESSION['IdPenyewaan'];
      $Nama        = $_POST['Nama'];
      $WaktuSewa   = $_POST['WaktuSewa'];
      $WaktuBalik  = $_POST['WaktuBalik'];
      $Alamat      = $_POST['Alamat'];
      $Status      = $_POST['Status'];
      $str = str_replace('-', '', $WaktuSewa);
      $IdPenyewaan = $IdPenyewaan.$str;
      
      //Mempersiapkan Command Query  untuk mengupdate data Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql= "update penyewaan set NamaPenyewa = '$Nama', WaktuSewa = '$WaktuSewa', WaktuBalik = '$WaktuBalik', Alamat = '$Alamat', Status = '$Status' where IdPenyewaan = $IdPenyewaan";
        
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
      
      //Mengecek apakah terjadi perubahan di dalam database atau tidak
      $hasil=mysqli_affected_rows($conn);
        
      if($hasil)
      {
        unset($_SESSION['IdPenyewaan']);
        switch($Level)
        {
          case 1:
            header("location: ../index_teknisi.php");
          break;
          case 2:
            header("location: ../kelola_sewa.php");
          break;
          case 3:
            header("location: ../daftar_penyewaan_utama.php");
          break;
        }
      }
      else
      {
        echo "Data Gagal Di Ubah";
        switch($Level)
        {
          case 2:
            header("Refresh: 5; ../kelola_sewa.php");
          break;
          case 3:
            header("Refresh: 5; ../daftar_penyewaan_utama.php");
          break;
        }
      }
    }  
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>