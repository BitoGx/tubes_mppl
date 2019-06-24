<?php
  //Session Start
  session_start();
  
  if(isset($_POST['username']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel ke lowercase
    */
    $username=$_POST['username'];
    $username = strtolower($username);
    $password=$_POST['password'];
    $password = $password;
    $_SESSION['Control'] = "true";
    
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";
  
    //Memilih database
    mysqli_select_db($conn,"dellaria");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select IdUser,Nama,Level,Status from user where Username='$username' and Password=sha1('$password')";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    //Menjalankan perintah perulangan sebanyak yang dibutuhkan
    if($row)
    {
      list($IdUser,$Nama,$Level,$Status)=$row;
      $_SESSION['Id']=$IdUser;
      $_SESSION['Nama']=$Nama;
      $_SESSION['Level']=$Level;
      $_SESSION['Status']=$Status;
      $_SESSION['Loggedin']="true";
        
      //Memisahkan Level setiap pekerja
      switch($Level)
      {
        case 1:
          $_SESSION['JobDesc']="Teknisi";
          header("location: ../index_teknisi.php");
        break;
        case 2:
          $_SESSION['JobDesc']="Penanggung Jawab";
          header("location: ../index_penanggung.php");
        break;
        case 3:
          $_SESSION['JobDesc']="Pemilik";
          header("location: ../index.php");
        break;
      }
    }
    //Jika Username atau Password salah maka menampilkan pesan salah
    else
    {
      echo "<center><h1>USERNAME DAN PASSWORD SALAH</h1></center>";
      $_SESSION['Loggedin']="false";
      header("Refresh: 5; location: ../login.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
  
  
?>