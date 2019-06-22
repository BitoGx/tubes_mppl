<?php
  //Session Start
  session_start();

  if(isset($_POST['IdPenyewaan']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $IdPenyewaan = $_POST['IdPenyewaan'];
    $NamaPenyewa = $_POST['NamaPenyewa'];
    $WaktuSewa   = $_POST['WaktuSewa'];
    $WaktuBalik  = $_POST['WaktuBalik'];
    $Alamat      = $_POST['Alamat'];
    $Status      = $_POST['Status'];
    $NamaPenyewa = ucwords($NamaPenyewa);

    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";

    //Memilih database
    mysqli_select_db($conn,"dellaria");

    //Mempersiapkan Command Query  untuk mengecek apakah IdPenyewaan yang ditambahkan sudah ada atau belum
    $sql="select * from barang where IdPenyewaan='$IdPenyewaan'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf tanggal yang dipilih tidak tersedia";
      header("Refresh: 10;http://localhost/tubes_mppl/teknisi_daftar_barang.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan Data Penyewaan baru
      $sql="insert into penyewaan (IdPenyewaan,NamaPenyewa,WaktuSewa,WaktuBalik,Alamat,Status) value ($IdPenyewaan, '$NamaPenyewa', '$WaktuSewa', '$WaktuBalik', '$Alamat', '$Status')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Mengecek apakah perintah query berhasil atau gagal
      if($hasil)
      {
        $Level = $_SESSION['Level'];
        switch($Level)
        {
          case 1:
            header("location: ../teknisi_daftar_barang.php");
          break;
          case 2:
            header("location: ../kelola_sewa.php");
          break;
          case 3:
            header("location: ../kelola_sewa_utama.php");
          break;
        }
      }
      else
      {
        //Jika Penambahan Barang gagal akan menampilkan pesan error
        echo "Barang yang ditambahkan gagal";
        header("Refresh: 10; http://localhost/tubes_mppl/kelola_sewa.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
