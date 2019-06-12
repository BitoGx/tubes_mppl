<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select * from barang";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    echo "<form action='php/tambah_barang.php' method='post' onsubmit='return FormValidation()'>";
    echo "<tr>
            <td><input type='text' name='NamaBarang' pattern='[A-Za-z]+' required>
            <td><input type='number' name='Jumlah' min='1' required>
            <td><input type='submit' name='tambah' value='Tambah'>";
    echo "</form>";
    do
    {
      list($IdBarang,$NamaBarang,$Jumlah)=$row;
      echo "<form action='php/hapus_barang.php' method='post' onsubmit='return FormValidation()'>";
      echo "<tr>
              <td>$NamaBarang
              <td>$Jumlah
              <td><input type='submit' name='Action' value='Hapus'><input type='hidden' name='IdBarang' value='$IdBarang'>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  else
  {
    echo "<center><h1>Tidak ada Barang</h1></center>";
  }
?>