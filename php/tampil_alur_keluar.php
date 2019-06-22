<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select IdPenyewaan,NamaPenyewa,WaktuSewa from penyewaan";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    do
    {
      list($IdPenyewaan,$NamaPenyewa,$WaktuSewa)=$row;
      echo "<form action='php/kelola_barang_keluar.php' method='post'>";
      echo "<tr>
              <td>$NamaPenyewa
              <td>$WaktuSewa
              <td><input type='submit' name='Action' value='Atur'><input type='hidden' name='IdPenyewaan' value='$IdPenyewaan'>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  else
  {
    echo "<center><h1>Tidak ada Barang</h1></center>";
  }
?>