<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select b.IdBarang,b.NamaBarang,b.Jumlah,sb.Baik,sb.Maintanance,sb.Rusak from barang as b,status_barang as sb where b.IdBarang = sb.IdBarang";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    do
    {
      list($IdBarang,$NamaBarang,$Jumlah,$Baik,$Maintanance,$Rusak)=$row;
      echo "<form action='barang.php' method='post'>";
      echo "<tr>
              <td>$NamaBarang
              <td>$Jumlah
              <td>$Baik
              <td>$Maintanance
              <td>$Rusak
              <td><input type='submit' name='Action' value='Atur'><input type='hidden' name='IdBarang' value='$IdBarang'>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  else
  {
    echo "<center><h1>Tidak ada Barang</h1></center>";
  }
?>