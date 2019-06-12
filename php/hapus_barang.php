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
    
    if($hasil)
    {
      $Level = $_SESSION['Level'];
      switch($Level)
      {
        case 1:
          header("location: ../teknisi_kelola_barang.php");
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
      echo "Barang gagal dihapus";
      header("Refresh: 10; http://localhost/tubes_mppl/teknisi_kelola_barang.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }

?>