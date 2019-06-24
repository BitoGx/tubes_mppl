<html>
<head>
  <title> Penyewaan </title>
  <script language="javascript">
    function CheckDate()
    {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      if(dd<10)
      {
        dd='0'+dd
      } 
      if(mm<10)
      {
        mm='0'+mm
      } 
      today = yyyy+'-'+mm+'-'+dd;
      document.getElementById("WaktuSewa").setAttribute("min", today);
      document.getElementById("WaktuBalik").setAttribute("min", today);
    }
    
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
                <td><input type='date' id='WaktuSewa' name='WaktuSewa' onclick='CheckDate()' value=$WaktuSewa></td>
              </tr>
              <tr>
                <td>Waktu Kembali</td>
                <td>$WaktuBalik</td>
                <td><input type='date' id='WaktuBalik' name='WaktuBalik' onclick='CheckDate()' value=$WaktuBalik></td>
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