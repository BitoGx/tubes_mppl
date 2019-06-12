<?php
  $dbhost = "192.168.100.7";
  $dbname = "dellaria";
  $dbuser = "admin";
  $dbpass = "123adm123";

  // Buat Koneksi
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check Koneksi Nerhasil atau Tidak
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
  else
  {
    unset ($_SESSION["Control"]);
  }
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
    
  //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
  $sql="select * from barang where NamaBarang='Test'";
    
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
    
  if($hasil)
  {
    echo "True";
  }
  else
  {
    echo "Gah";
  }
?>