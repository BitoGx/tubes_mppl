<html>
<head>
  <title> Penyewaan </title>
  <script language="javascript">
    function FormValidation()
    {   
      //Menyimpan nilai variable Object kedalam Variabel biasa dan mengecek agar total barang sesuai
      var WaktuSewa = document.getElementById("WaktuSewa");
      var Sewa = WaktuSewa.value;
      Sewa = Sewa.replace(/[^a-z\d\s]+/gi, "");
      var WaktuBalik = document.getElementById("WaktuBalik");
      var Balik = WaktuBalik.value;
      Balik = Balik.replace(/[^a-z\d\s]+/gi, "");
      if(Balik < Sewa)
      {
        alert("Maaf tanggal sewa tidak boleh kurang dari tanggal beres penyewaan");
        return false;
      }
      else
      {
        return true;
      }
      
    }
  </script>
</head>
<body>
<center>
  <form action="kelola_penyewaan.php" onsubmit="return FormValidation()" method="post">
  <table border="1">
  <?php
    
    //Session Start
    session_start();
    
    $level = $_SESSION['Level'];

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
                <td><input type='text' id='WaktuSewa' name='WaktuSewa' value=$WaktuSewa pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' title='yyyy-mm-dd'></td>
              </tr>
              <tr>
                <td>Waktu Kembali</td>
                <td>$WaktuBalik</td>
                <td><input type='text' id='WaktuBalik' name='WaktuBalik' value=$WaktuBalik pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' title='yyyy-mm-dd'></td>
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
      switch($level)
      {
        case 1:
          header("location: ../index_teknisi.php");
          exit;
        break;
        case 2:
          header("location: ../kelola_sewa.php");
          exit;
        break;
        case 3:
          header("location: ../daftar_penyewaan_utama.php");
          exit;
        break;
      }
    }
    echo "</table>";
    echo "<input type='submit' value='Simpan'>";
    switch($level)
    {
      case 2:
        echo "<a href='../kelola_sewa.php'><input type='button' value='Batal'></a>";
        exit;
      break;
      case 3:
        echo "<a href='../daftar_penyewaan_utama.php'><input type='button' value='Batal'></a>";
        exit;
      break;
    } 
  ?>
  </form>
</body>
</html>