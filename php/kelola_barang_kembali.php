<html>
<head>
  <title> Penyewaan </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
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

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<center>
  <table align="center" class="table table-stripe" style="width:70%">
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
      $level = $_SESSION['Level'];

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
          header("location: ../alur_kembali.php");
          exit;
        break;
        case 3:
          header("location: ../alur_kembali_utama.php");
          exit;
        break;
      }
    }
    echo "</table>";
    switch($level)
      {
        case 2:
          echo "<a href='../alur_kembali.php'><input type='button' value='Batal'></a>";
          break;
        break;
        case 3:
          echo "<a href='../alur_kembali_utama.php'><input type='button' value='Batal'></a>";
          break;
        break;
      }
  ?>
</body>
</html>
