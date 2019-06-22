<?php
  //Session Start
  session_start();
  
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  require_once "connection.php";
      
  if((isset($_POST['namabarangp'])) and (isset($_POST['IdPenyewaan'])))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    */
    
    $namabarangp=$_POST['namabarangp'];
    $IdPenyewaan=$_POST['IdPenyewaan'];
    $_SESSION['IdPenyewaan'] = $IdPenyewaan;

    //Memilih database
    mysqli_select_db($conn,"dellaria");

    //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
    $sql="select * from detail_penyewaan where IdBarang='$namabarangp' and IdPenyewaan='$IdPenyewaan'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf barang sudah ada di dalam database";
      header("Refresh: 5; ../penyewaan.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan barang baru
      $sql="insert into detail_penyewaan (IdPenyewaan,IdBarang) value ('$IdPenyewaan','$namabarangp')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        //Mempersiapkan Command Query  untuk mengambil barang yang sudah ditambahkan
        $sql="select IdPenyewaan,IdBarang from detail_penyewaan where IdBarang='$namabarangp' and IdPenyewaan='$IdPenyewaan'";

        //Menjalankan perintah query dan menyimpannya dalam variabel hasil
        $hasil=mysqli_query ($conn,$sql);

        //Mengambil 1 baris hasil dari perintah query
        $row=mysqli_fetch_row($hasil);

        //Mengecek apakah barang yang dimasukan tadi ditemukan atau tidak
        if($row)
        {
          header("location: ../penyewaan.php");
        }
        else
        {
          echo "Barang yang ditambahkan tidak ditemukan";
          header("Refresh: 5; ../penyewaan.php");
        }
      }
      else
      {
        //Jika Penambahan Barang gagal akan menampilkan pesan error
        echo "Barang yang ditambahkan gagal";
        header("Refresh: 5; ../penyewaan.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }


?>
