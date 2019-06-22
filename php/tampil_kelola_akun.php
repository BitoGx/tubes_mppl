<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select IdUser,Username,Nama,Level,Status from user";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    echo "<form action='php/tambah_akun.php' method='post'>";
    echo "<tr>
            <td>Username</td>
            <td><input type='text' name='Username' required></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type='password' name='pass1' id='pass1' pattern='[A-Za-z0-9].{5,}' title='Panjang password minimal 6 huruf dapat terdiri huruf besar/kecil dan angka' required></td>
          </tr>
          <tr>
            <td>Re-Password</td>
            <td><input type='password' name='pass3' id='pass2' pattern='[A-Za-z0-9].{5,}' title='Panjang password minimal 6 huruf dapat terdiri huruf besar/kecil dan angka' required></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><input type='text' name='Nama' pattern='[A-Za-z ]+' required></td></tr>
          <tr>
            <td>Level</td>
            <td>
              <select name='Level' required>
                <option value='' disabled selected >Tingkat</option>
                <option value='1'>Teknisi</option>
                <option value='2'>Penanggun Jawab</option>
              </select>
            </td>
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
    do
    {
      list($IdBarang,$NamaBarang,$Jumlah)=$row;
      echo "<form action='php/hapus_barang.php' method='post'";
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