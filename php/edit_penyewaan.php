<html>
<head>
  <title> Penyewaan </title>
</head>
<body>
<center>
  <form action="kelola_penyewaan.php" method="post">
  <table border="1">
  <?php
    
    //Session Start
    session_start();

    if(isset($_POST['IdPenyewaan']))
    {
      //Menyimpan Variabel yang di kirim menggunakan method POST
      $IdPenyewaan=$_POST['IdPenyewaan'];
      $_SESSION['IdPenyewaan']=$IdPenyewaan;
      $_SESSION['Control'] = "true";
      
      //Memanggil Connection.php
      require_once "connection.php";
      
      //Memilih database
      mysqli_select_db($conn,"dellaria");
  
      //Mempersiapkan Command Query  untuk mengambil data IdBarang,NamaBarang,Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql="select NamaPenyewa,WaktuSewa,WaktuBalik,Alamat,Status from penyewaan where IdPenyewaan=$IdPenyewaan";
      
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
  
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
      
      if($row)
      {
        list($NamaPenyewa,$WaktuSewa,$WaktuBalik,$Alamat,$Status)=$row;
        echo "<tr>
                <th colspan='3'>$IdPenyewaan</th>
              </tr>
              <tr>
                <td>Nama Penyewa</td>
                <td>$NamaPenyewa</td>
                <td><input type='text' name='Nama' value=$NamaPenyewa ></td>
              </tr>
              <tr>
                <td>Waktu Penyewaan</td>
                <td>$WaktuSewa</td>
                <td><input type='text' name='WaktuSewa' value=$WaktuSewa pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' title='yyyy-mm-dd'></td>
              </tr>
              <tr>
                <td>Waktu Kembali</td>
                <td>$WaktuBalik</td>
                <td><input type='text' name='WaktuBalik' value=$WaktuBalik pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' title='yyyy-mm-dd'></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>$Alamat</td>
                <td><textarea name='Alamat' cols=40 rows=3>$Alamat</textarea></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>$Status</td>
                <td>
                  <select name='Status' required>
                    <option value='' disabled selected >Status</option>
                    <option value='Tuntas'>Tuntas</option>
                    <option value='Tidak Tuntas'>Tidak Tuntas</option>
                    <option value='Cancel'>Cancel</option>
                  </select>
                </td>
              </tr>";
      }
      
    }
    else
    {
      //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
      require_once "session_check_dalam.php";
      $level = $_SESSION['Level'];
      switch($level)
      {
         case 1:
          header("location: ../ndex_teknisi.php");
          exit;
        break;
        case 2:
          header("location: ../index_penanggung.php");
          exit;
        break;
        case 3:
          header("location: ../index.php");
          exit;
        break;
      }
    }
  ?>
  </table>
  <input type="submit" value="Simpan">
  <a href="../kelola_sewa.php">
    <input type="button" value="Batal">
  </a>
  </form>
</body>
</html>