<html>
<head>
  <title> Barang </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body>
<center>
  <form action="kelola_akun.php" method="post">
  <table class="table table-stripe" style="width:50%">
  <?php

    //Session Start
    session_start();

    if(isset($_POST['IdUser']))
    {

      //Menyimpan Variabel yang di kirim menggunakan method POST
      $IdUser=$_POST['IdUser'];
      $_SESSION['IdUser']=$IdUser;
      $_SESSION['Control'] = "true";

      //Memanggil Connection.php
      require_once "connection.php";

      //Memilih database
      mysqli_select_db($conn,"dellaria");

      //Mempersiapkan Command Query  untuk mengambil data IdBarang,NamaBarang,Jumlah,Baik,Maintenance,Rusak berdasarkan IdBarang
      $sql="select IdUser,Username,Nama,Level,Status from user where IdUser = $IdUser";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);

      if($row)
      {
        list($IdUser,$Username,$Nama,$Level,$Status)=$row;
        switch($Level)
        {
          case 1:
            $JobDesc = "Teknisi";
          break;
          case 2:
            $JobDesc = "Penanggung Jawab";
          break;
          case 3:
            $JobDesc = "Pemilik";
          break;
        }
        switch($Status)
        {
          case 1:
            $Stat = "Aktif";
          break;
          case 0:
            $Stat = "Non-Aktif";
          break;
        }
        echo "<tr>
                <th colspan='3'>Id User : $IdUser</th>
              </tr>
              <tr>
                <td>Username</td>
                <td>$Username</td>
                <td><input type='text' name='Username' value=$Username></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>$Nama</td>
                <td><input type='text' name='Nama' value=$Nama></td>
              </tr>
              <tr>
                <td>Level</td>
                <td>$JobDesc</td>
                <td>
                  <select name='Level' required>
                    <option value='' disabled selected >Tingkat</option>
                    <option value='1'>Teknisi</option>
                    <option value='2'>Penanggung Jawab</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Status</td>
                <td>$Stat</td>
                <td>
                  <select name='Status' required>
                    <option value='' disabled selected >Status</option>
                    <option value='1'>Aktif</option>
                    <option value='0'>Non-Aktif</option>
                  </select>
                </td>
              </tr>";
      }
    }
    else
    {
      //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
      require_once "php/session_check.php";
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
    echo "</table>";
    echo "<input type='submit' value='Simpan'>";
    echo "<a href='../kelola_akun_semua_utama.php'><input type='button' value='Batal'></a>";
  ?>
  </form>
</body>
</html>
