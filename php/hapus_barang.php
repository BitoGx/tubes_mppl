<?php
  //Session Start
  session_start();

  if(isset($_POST['IdBarang']))
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST
    $idbarang=$_POST['IdBarang'];

    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";

    //Memilih database
    mysqli_select_db($conn,"dellaria");

    //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
    $sql="delete from barang where IdBarang = $idbarang";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
    
    $Level = $_SESSION['Level'];
    if($hasil)
    {
      switch($Level)
      {
        case 1:
          header("location: ../teknisi_daftar_barang.php");
        break;
        case 3:
          header("location: ../daftar_barang_utama.php");
        break;
      }
    }
    else
    {
      echo "Barang gagal dihapus";
      switch($Level)
      {
        case 1:
          header("Refresh: 5; ../teknisi_daftar_barang.php");
        break;
        case 3:
          header("Refresh: 5; ../daftar_barang_utama.php");
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
