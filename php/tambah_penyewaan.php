<?php
  //Session Start
  session_start();

  if(isset($_POST['IdPenyewaan']))
  {
    $WaktuSewa   = $_POST['WaktuSewa'];

    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";
      
    $Level = $_SESSION['Level'];

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
      /*
      *Menyimpan Variabel yang di kirim menggunakan method POST
      *Mengubah isi variabel nama barang ke CamelCase
      */
      $IdPenyewaan = $_POST['IdPenyewaan'];
      $NamaPenyewa = $_POST['NamaPenyewa'];
      $WaktuSewa   = $_POST['WaktuSewa'];
      $str         = str_replace('-', '', $WaktuSewa);
      $IdPenyewaan = str_replace('-', '', $IdPenyewaan);
      $WaktuBalik  = $_POST['WaktuBalik'];
      $Alamat      = $_POST['Alamat'];
      $Status      = $_POST['Status'];
      $NamaPenyewa = ucwords($NamaPenyewa);
      $IdPenyewaan = $IdPenyewaan.$str;
      
      //Mempersiapkan Command Query  untuk menambahkan Data Penyewaan baru
      $sql="insert into penyewaan (IdPenyewaan,NamaPenyewa,WaktuSewa,WaktuBalik,Alamat,Status) value ('$IdPenyewaan', '$NamaPenyewa', '$WaktuSewa', '$WaktuBalik', '$Alamat', '$Status')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Mengecek apakah perintah query berhasil atau gagal
      if($hasil)
      {
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
        //Jika Penambahan Barang gagal akan menampilkan pesan error
        echo "Penyewaan yang ditambahkan gagal";
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
