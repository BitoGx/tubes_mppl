<?php
session_start();

if((isset($_SESSION['Level'])) and ($_SESSION['Status'] != 0))
{
  if($_SESSION['Status'] != 0)
  {
    session_destroy();
  }
  $Level = $_SESSION['Level'];
  switch($Level)
  {
    case 1:
      header("location: index_teknisi.php");
    break;
    case 2:
      header("location: index_penanggung.php");
    break;
    case 3:
      header("location: index.php");
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Masuk</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="js/bootstrap.js">
  <style>
    html,
    body {
      height: 100%;
    }
  </style>
</head>
<body class="d-flex justify-content-center  bg-light">
  <div class="d-flex h-100" <div class="d-flex h-100">
    <!-- login box -->
    <div class="m-auto">
      <h1><b>Halaman</b> Admin</h1>
      <br>
      <div class="card">
        <div class="card-body">
          <form class="form" action="php/session_login.php" method="POST" name="login">
            <div class="form-group">
              <h3 class="login-header"><b>Masuk</b></h2>
            </div>
            <div class="form-group">
              <label>Nama Pengguna</label>
              <input type="text" name="username" placeholder="Masukan Akun" class="username-input form-control" required>
            </div>
            <div class="form-group">
              <label>Kata Sandi</label>
              <input type="password" name="password" placeholder="Masukan Kata Sandi" class="password-input form-control" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" name="remember" class="form-check-input"><span>Ingat saya</span>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Masuk" class="btn btn-primary btn-block">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
