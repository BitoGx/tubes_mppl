<?php
  //Session Start
  session_start();
 
  if(isset($_POST['Username']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $Username = $_POST['Username'];
    $Nama = $_POST['Nama'];
    $Nama = ucwords($Nama);
    $Pass=$_POST['pass1'];
    $Pass=sha1($Pass);
    $Level=$_POST['Level'];
    $Status=$_POST['Status'];
    $Username=strtolower($Username);

    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";

    //Memilih database
    mysqli_select_db($conn,"dellaria");

    //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
    $sql="select * from user where Username='$Username'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf Usernamr sudah terdaftar di dalam database";
      header("Refresh: 5; ../kelola_akun_semua_utama.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan barang baru
      $sql="insert into user (IdUser,Username,Password,Nama,Level,Status) value (NULL,'$Username','$Pass','$Nama',$Level,$Status)";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        header("location: ../kelola_akun_semua_utama.php");
      }
      else
      {
        //Jika Penambahan User gagal akan menampilkan pesan error
        echo "User yang ditambahkan gagal";
        header("Refresh: 5; ../kelola_akun_semua_utama.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
