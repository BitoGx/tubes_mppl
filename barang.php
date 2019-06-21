<html>
<head>
  <title> Barang </title>
  <script language="javascript">
    function FormValidation() 
    {
      //Menyimpan nilai variable Object kedalam Variabel biasa dan mengecek agar total barang sesuai
      var Total = document.getElementById("Total");
      var total_mulai = Total.value;
      var Baik = document.getElementById("Baik");
      var baik = Baik.value;
      var Maintenance = document.getElementById("Maintenance");
      var maintanance = Maintenance.value;
      var Rusak = document.getElementById("Rusak");
      var rusak = Rusak.value;
      var total_akhir = +baik + +maintanance + +rusak;
      var check = total_mulai - total_akhir;
      if(check != 0)
      {
        alert("Maaf Total barang "+check+" dari yang seharusnya ");
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
  <form action="php/kelola_barang.php" name="Edit" onsubmit="return FormValidation()"  method="post">
  <table border="1">
  <?php
    
    //Session Start
    session_start();
    
    if(isset($_POST['IdBarang']))
    {
      
      //Menyimpan Variabel yang di kirim menggunakan method POST
      $IdBarang=$_POST['IdBarang'];
      $_SESSION['IdBarang']=$IdBarang;
      $_SESSION['Control'] = "true";
      
      //Memanggil Connection.php
      require_once "php/connection.php";
      
      //Memilih database
      mysqli_select_db($conn,"dellaria");
  
      //Mempersiapkan Command Query  untuk mengambil data IdBarang,NamaBarang,Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql="select b.IdBarang,b.NamaBarang,b.Jumlah,sb.Baik,sb.Maintenance,sb.Rusak from barang as b,status_barang as sb where b.IdBarang = sb.IdBarang and b.IdBarang=$IdBarang";
  
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
  
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
      
      if($row)
      {
        list($IdBarang,$NamaBarang,$Jumlah,$Baik,$Maintenance,$Rusak)=$row;
        echo "<tr>
                <th colspan='3'>$NamaBarang</th>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>$Jumlah</td>
                <td><input type='number' id='Total' name='Total' value=$Jumlah min='0'></td>
              </tr>
              <tr>
                <td>Baik</td>
                <td>$Baik</td>
                <td><input type='number' id='Baik' name='Baik' value=$Baik min='0'></td>
              </tr>
              <tr>
                <td>Maintenance</td>
                <td>$Maintenance</td>
                <td><input type='number' id='Maintenance' name='Maintenance' value=$Maintenance min='0'></td>
              </tr>
              <tr>
                <td>Rusak</td>
                <td>$Rusak</td>
                <td><input type='number' id='Rusak' name='Rusak' value=$Rusak min='0'></td>
              </tr>";
      }
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
  <input type="submit" value="Simpan">
  <a href="index_teknisi.php">
    <input type="button" value="Batal">
  </a>
  </form>
</body>
</html>