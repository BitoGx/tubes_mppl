<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/skins/_all-skins.min.css">
<!-- Morris chart -->
<link rel="stylesheet" href="bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    echo "<table align='center' class='table table-stripe' style='width:70%''>";
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
