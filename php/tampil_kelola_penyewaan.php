<?php
  
  $Today = date("Y-m-d");
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select IdPenyewaan,NamaPenyewa,WaktuSewa,WaktuBalik,Alamat,Status from penyewaan";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    echo "<form action='php/tambah_penyewaan.php' onsubmit='return FormValidation()' method='post'>";
    echo "<tr>
            <td>Nama Penyewa</td>
            <td><input type='text' name='NamaPenyewa' pattern='[A-Za-z ]+' required></td>
          <tr>
          <tr>
            <td>Tanggal Sewa</td>
            <td><input type='date' id='WaktuSewa' name='WaktuSewa' onclick='CheckDate()' value=$Today></td>
          </tr>
          <tr>
            <td>Tanggal Beres</td>
            <td><input type='date' id='WaktuBalik' name='WaktuBalik' onclick='CheckDate()' value=$Today></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><textarea name='Alamat' cols=40 rows=3></textarea>
          </tr>
          <tr>
            <td>Status</td>
            <td>
              <select name='Status' required>
                <option value='' disabled selected >Status</option>
                <option value='Tuntas'>Tuntas</option>
                <option value='Tidak Tuntas'>Tidak Tuntas</option>
                <option value='Cancel'>Cancel</option>
              </select>
            </td>
          </tr> 
          <tr>
            <td colspan=2>
              <input type='submit' name='Action' value='Tambah'><input type='hidden' name='IdPenyewaan' value='$Today'>
            </td>
          <tr>";
    echo "</form>";
    echo "</table><br>";
    echo "<table border=2>";
    echo "<tr>
            <td> Nama Penyewa </td>
            <td> Waktu Sewa </td>
            <td> Waktu Balik </td>
            <td> Alamat </td>
            <td> Status </td>
            <td> Edit </td>
          </tr>";
    do
    {
      list($IdPenyewaan,$NamaPenyewa,$WaktuSewa,$WaktuBalik,$Alamat,$Status)=$row;
      echo "<form action='php/edit_penyewaan.php' method='post'>";
      echo "<tr>
              <td>$NamaPenyewa
              <td>$WaktuSewa
              <td>$WaktuBalik
              <td>$Alamat
              <td>$Status
              <td><input type='submit' name='Action' value='Edit'>
                  <input type='hidden' name='IdPenyewaan' value='$IdPenyewaan'>
                  <input type='hidden' name='WaktuSewa' value='$$WaktuSewa'>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  else
  {
    echo "<center><h1>Tidak ada Barang</h1></center>";
  }
?>