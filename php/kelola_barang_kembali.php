<html>
<head>
  <title> Penyewaan </title>
</head>
<body>
<center>
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
      require_once "connection.php";
      
      //Memilih database
      mysqli_select_db($conn,"dellaria");
  
      //Mempersiapkan Command Query  untuk mengambil data IdBarang,NamaBarang,Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql="select b.IdBarang,b.NamaBarang,dp.JumlahBarang,dp.BarangKeluar,dp.BarangMasuk from barang as b, detail_penyewaan as dp where dp.IdPenyewaan=$IdPenyewaan and b.IdBarang=dp.IdBarang";
  
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
  
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
      
      if($row)
      {
        echo "<tr>
                <th colspan='6'>Id Penyewaan $IdPenyewaan</th>
              </tr>
              <tr>
                <td>Nama Barang</td>
                <td>Yang Disewakan</td>
                <td>Barang Keluar</td>
                <td>Barang Masuk sebelum</td>
                <td>Barang Masuk sesudah</td>
                <td>Edit</td>
              </tr>";
        do
        {
          list($IdBarang,$NamaBarang,$JumlahBarang,$BarangKeluar,$BarangMasuk)=$row;
          echo "<form action='edit_detail_penyewaan.php' method='post'>";
          echo "<tr>
                  <td>$NamaBarang</td>
                  <td>$JumlahBarang</td>
                  <td>$BarangKeluar</td>
                  <td>$BarangMasuk</td>
                  <td><input type='number' id='Total' name='Jumlah' value=$BarangMasuk min='0' max='$BarangKeluar'></td>
                  <td><input type='submit' name='Shinobi' value='Atur'>
                      <input type='hidden' name='Action' value='Masuk'>
                      <input type='hidden' name='IdPenyewaan' value='$IdPenyewaan'>
                      <input type='hidden' name='IdBarang' value='$IdBarang'>
                </tr>";
          echo "</form>";
        }
        while($row=mysqli_fetch_row($hasil));
      } 
    }
    else
    {
      //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
      require_once "session_check_dalam.php";
      switch($level)
      {
         case 1:
          header("location: ../index_teknisi.php");
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
    $level = $_SESSION['Level'];
    echo "</table>";
    switch($level)
      {
        case 2:
          echo "<a href='../alur_keluar.php'><input type='button' value='Batal'></a>";
          break;
        break;
        case 3:
          echo "<a href='../alur_keluar_utama.php'><input type='button' value='Batal'></a>";
          break;
        break;
      }
  ?>
</body>
</html>