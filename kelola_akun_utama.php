<?php
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  require_once "php/session_check.php";

  //Menyimpan data dari session
  $id      = $_SESSION['Id'];
  $nama    = $_SESSION['Nama'];
  $level   = $_SESSION['Level'];
  $jobdesc = $_SESSION['JobDesc'];

  //Mengecek role pengguna
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
  }
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
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

  <script language="javascript">
  function PassCheck()
  {
    var passlama = document.getElementById("passlama")
    var pass1 = document.getElementById("passbaru1");
    var pass2 = document.getElementById("passbaru2");
    if((passlama.value == pass1.value) || (passlama.value == pass2.value))
    {
      alert("Password lama tidak boleh sama dengan password yang baru");
      return false;
    }
    else
    {
      if(pass1.value == pass2.value)
      {
        return true;
      }
      else
      {
        alert("Passwod yang anda masukkan tidak sama");
        return false;
      }
    }
  }

  function UserCheck()
  {
    var user1 = document.getElementById("userbaru");
    var user3 = document.getElementById("userlama");
    var userbaru1 = user1.value;
    var userlama = user3.value;
    userbaru1 = userbaru1.toLowerCase();
    userlama  = userlama.toLowerCase();
    if((userbaru1 == userlama) || (userbaru2 == userlama))
    {
      alert("Maaf username tidak boleh sama dengan sebelumnya");
      return false;
    }
    else
    {
      if (window.confirm('Apa anda yakin akan melakukan operasi ini ?'))
      {
        return true;
      }
      else
      {
        return false;
      }
    }
  }
  </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <span class="logo-lg"><b>Dellaria</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Nama : <?php echo $nama; ?></span>
              </a>
                <li class="user-footer">
                    <a href="php/session_logout.php" class="btn btn-default btn-flat">Keluar</a>
                </li>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu Utama</li>
          <li class="active">
            <a href="index.php">
              <i class="fa fa-circle-o-notch"></i>
              <span>Alur Waktu</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Penyewaan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="detail_penyewaan_utama.php"><i class="fa fa-circle-o"></i>Detail Penyewaan</a></li>
              <li><a href="daftar_penyewaan_utama.php"><i class="fa fa-circle-o"></i>Daftar penyewaan</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Barang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="detail_barang_utama.php"><i class="fa fa-circle-o"></i>Detail barang</a></li>
              <li><a href="daftar_barang_utama.php"><i class="fa fa-circle-o"></i>Daftar Barang</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i>
              <span>Alur barang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="alur_keluar_utama.php"><i class="fa fa-circle-o"></i>alur barang keluar</a></li>
              <li><a href="alur_kembali_utama.php"><i class="fa fa-circle-o"></i>alur barang kembali</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>Akun</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i>Kelola Akun saya</a></li>
              <li><a href="kelola_akun_semua_utama.php"><i class="fa fa-circle-o"></i>Kelola Semua Akun</a></li>
            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Kelola Akun
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <form action="php/ganti_username.php" method="post" onsubmit='return UserCheck()'>
          <table align="center" class="table table-stripe" style="width:70%">
            <tr>
              <td>Username Lama : </td>
              <td><input type="text" name="userlama" id="userlama" required> </td>
            </tr>
            <tr>
              <td>Username Baru :</td>
              <td><input type="text" name="userbaru" id="userbaru" required></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
            </tr>
          </table>
        </form>
        <form action="php/ganti_password.php" method="post" onsubmit='return PassCheck()'>
          <table align="center" class="table table-stripe" style="width:70%">
            <tr>
              <td>Password Lama : </td>
              <td><input type="password" name="passlama" id="passlama" required> </td>
            </tr>
            <tr>
              <td rowspan="2">Password Baru :</td>
              <td><input type="password" name="passbaru1" id="passbaru1" pattern="[A-Za-z0-9].{5,}" title="Panjang password minimal 6 huruf dapat terdiri huruf besar/kecil dan angka" required></td>
            </tr>
            <tr>
              <td><input type="password" name="passbaru2" id="passbaru2" pattern="[A-Za-z0-9].{5,}" title="Panjang password minimal 6 huruf dapat terdiri huruf besar/kecil dan angka" required></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
            </tr>
          </table>
        </form>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <b>Version</b> 1.0
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="bower_components/raphael/raphael.min.js"></script>
  <script src="bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="bower_components/moment/min/moment.min.js"></script>
  <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
</body>

</html>
