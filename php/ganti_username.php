<?php
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if(isset($_SESSION['Id']))
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST dan mengambil Id User dari SESSION
    $id = $_SESSION['Id'];
    $userbaru = $_POST['userbaru1'];
    $userbaru = strtolower($userbaru);
    $userlama = $_POST['userlama'];
    $userlama = strtolower($userlama);
    
    //Memilih database
    mysqli_select_db($conn,"dellaria");
    
    //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
    $sql="select * from user where Username='$userbaru'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
    
    if($row)
    {
      
      header("Refresh: 2;http://localhost/tubes_mppl/kelola_akun_utama.php");
      echo "Maaf Username sudah digunakan";
    }
    else
    {
   
      //Mempersiapkan Command Query  untuk mengupdate Username user
      $sql= "update user set Username ='$userbaru' where IdUser=$id and Username='$userlama'";
      
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
    
      //Mengecek apakah terjadi perubahan di dalam database atau tidak
      $hasil=mysqli_affected_rows($conn);
    
      if($hasil)
      {
      
        $Level = $_SESSION['Level'];
        switch($Level)
        {
          case 1:
            header("location: ../kelola_akun_teknisi.php");
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
        echo "Username lama yang anda masukkan salah";
       header("Refresh: 10; http://localhost/tubes_mppl/kelola_akun_utama.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>