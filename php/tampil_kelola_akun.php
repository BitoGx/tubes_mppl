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
                <option value='2'>Penanggung Jawab</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Status</td>
            <td>
              <select name='Status' required>
                <option value='' disabled selected >Status</option>
                <option value='0'>Non-Aktif</option>
                <option value='1'>Aktif</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan=2>
              <input type='submit' name='Action' value='Tambah'>
            </td>
          <tr>";
    echo "</form>";
    echo "</table>
          <br>
          <table align='center' class='table table-stripe' style='width:70%''>";
    echo "<tr>
            <td>Username</td>
            <td>Nama</td>
            <td>Level</td>
            <td>Status</td>
            <td>Edit</td>
          </tr>";
    do
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

      echo "<form action='php/edit_akun.php' method='post'";
      echo "<tr>
              <td>$Username</td>
              <td>$Nama</td>
              <td>$JobDesc</td>
              <td>$Stat</td>
              <td><input type='submit' name='Action' value='Edit'><input type='hidden' name='IdUser' value='$IdUser'></td>
            </tr>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  else
  {
    echo "<center><h1>Tidak ada Barang</h1></center>";
  }
?>
