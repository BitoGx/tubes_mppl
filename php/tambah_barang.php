<?php
  //Session Start
  session_start();

  if(isset($_POST['NamaBarang']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $namabarang=$_POST['NamaBarang'];
    $namabarang=ucwords($namabarang);
    $jumlah=$_POST['Jumlah'];

    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";

    //Memilih database
    mysqli_select_db($conn,"dellaria");

    //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
    $sql="select * from barang where NamaBarang='$namabarang'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf barang sudah ada di dalam database";
      header("Refresh: 10; http://localhost/tubes_mppl/teknisi_daftar_barang.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan barang baru
      $sql="insert into barang (IdBarang,NamaBarang,Jumlah) value (NULL,'$namabarang','$jumlah')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        //Mempersiapkan Command Query  untuk mengambil barang yang sudah ditambahkan
        $sql="select IdBarang from barang where NamaBarang='$namabarang'";

        //Menjalankan perintah query dan menyimpannya dalam variabel hasil
        $hasil=mysqli_query ($conn,$sql);

        //Mengambil 1 baris hasil dari perintah query
        $row=mysqli_fetch_row($hasil);

        //Mengecek apakah barang yang dimasukan tadi ditemukan atau tidak
        if($row)
        {
          list($IdBarang)=$row;

          //Mempersiapkan Command Query  untuk menambahkan status barang yang ditambahkan
          $sql="insert into status_barang (IdBarang) value ('$IdBarang')";

          //Menjalankan perintah query dan menyimpannya dalam variabel hasil
          $hasil=mysqli_query ($conn,$sql);

          if($hasil)
          {
            $Level = $_SESSION['Level'];
            switch($Level)
            {
              case 1:
                header("location: ../teknisi_daftar_barang.php");
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
            echo "Status Barang yang ditambahkan gagal";
            header("Refresh: 10; http://localhost/tubes_mppl/teknisi_daftar_barang.php");
          }

        }
        else
        {
          echo "Barang yang ditambahkan tidak ditemukan";
          header("Refresh: 10; http://localhost/tubes_mppl/teknisi_daftar_barang.php");
        }
      }
      else
      {
        //Jika Penambahan Barang gagal akan menampilkan pesan error
        echo "Barang yang ditambahkan gagal";
        header("Refresh: 10; http://localhost/tubes_mppl/teknisi_daftar_barang.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }


?>
