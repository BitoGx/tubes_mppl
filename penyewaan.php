<html>
<head>
  <title> Penyewaan </title>
</head>
<body>
<center>
  <!-- <form action="php/kelola_barang.php" name="Edit" onsubmit="return FormValidation()"  method="post"> -->
  <table border="1">
  <?php
    
    //Session Start
    session_start();
    
    if(isset($_POST['IdPenyewaan']))
    {
      $IdPenyewaan=$_POST['IdPenyewaan'];
    }
    else
    {
      $IdPenyewaan=$_SESSION['IdPenyewaan'];
    }
    
    if((isset($_POST['IdPenyewaan'])) or (isset($_SESSION['IdPenyewaan'])))
    {
      //Menyimpan Variabel yang di kirim menggunakan method POST
      unset($_SESSION['IdPenyewaan']);
      $_SESSION['Control'] = "true";
      
      //Memanggil Connection.php
      require_once "php/connection.php";
      
      //Memilih database
      mysqli_select_db($conn,"dellaria");
  
      //Mempersiapkan Command Query  untuk mengambil data IdBarang,NamaBarang,Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql="select b.IdBarang,dp.JumlahBarang,b.NamaBarang,sb.Baik from detail_penyewaan as dp,barang as b,status_barang as sb where b.IdBarang=dp.IdBarang and b.IdBarang = sb.IdBarang and dp.IdPenyewaan=$IdPenyewaan ";
  
      $sql2 = "select IdBarang,NamaBarang from Barang";
      
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
  
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
      
      if($row)
      {
        echo "<tr>
                <th colspan='5'>$IdPenyewaan</th>
              </tr>
              <tr>
                <td>Nama Barang</td>
                <td>Siap Digunakan</td>
                <td>Sebelum Diubah</td>
                <td>Sesudah Diubah</td>
                <td>Edit</td>
              </tr>";
        do
        {
          list($IdBarang,$JumlahBarang,$NamaBarang,$Baik)=$row;
          echo "<form action='php/edit_detail_penyewaan.php' method='post'>";
          echo "<tr>
                  <td>$NamaBarang</td>
                  <td>$Baik</td>
                  <td>$JumlahBarang</td>
                  <td><input type='number' id='Total' name='Jumlah' value=$JumlahBarang min='0' max='$Baik'></td>
                  <td><input type='submit' name='Action' value='Atur'>
                      <input type='hidden' name='IdPenyewaan' value='$IdPenyewaan'>
                      <input type='hidden' name='IdBarang' value='$IdBarang'>
                </tr>";
          echo "</form>";
          
        }
        while($row=mysqli_fetch_row($hasil));
      } 
      
      //tambah barang penyewaan
      $hasil2=mysqli_query ($conn,$sql2);
      echo "<tr><td colspan='5'></td></tr>";
      echo "<form action='php/tambah_barang_penyewaan.php' method='post'>";
      echo "<tr> <td>";
      echo "<select name='namabarangp' onChange='Search(this.value)'>";
      echo "<option value='' disabled selected>Pilih Barang</option>";
      while ($row2 = mysqli_fetch_array($hasil2)) 
      {
        echo "<option value='" . $row2['IdBarang'] . "'>" . $row2['NamaBarang'] . "</option>";
      }
      echo "</select>";
      echo "<td></td>
            <td></td>
            <td></td>
            <td><input type='submit' name='tambah' value='Tambah'>
                <input type='hidden' name='IdPenyewaan' value='$IdPenyewaan'></td>
            </tr>";
      echo "</form>";      
    }
    else
    {
      //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
      require_once "php/session_check.php";
      $level = $_SESSION['Level'];
      switch($level)
      {
         case 1:
          header("location: ../tubes_mppl/index_teknisi.php");
          exit;
        break;
        case 2:
          header("location: ../tubes_mppl/index_penanggung.php");
          exit;
        break;
        case 3:
          header("location: ../tubes_mppl/index.php");
          exit;
        break;
      }
    }
  ?>
  </table>
  <a href="index_penanggung.php">
    <input type="button" value="Batal">
  </a>
  <!-- </form> -->
</body>
</html>