<?php
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Session Start
  session_start();
  
  //Menyimpan Variabel yang di kirim menggunakan method POST
  $username=$_POST['username'];
  $password=$_POST['password'];
  
  //Memilih database
  mysqli_select_db($conn,"dellaria");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select IdUser,Nama,Level from user where Username='$username' and Password=sha1('$password')";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);

  //Menjalankan perintah perulangan sebanyak yang dibutuhkan
  if($row)
  {
    do
      {
        list($IdUser,$Nama,$Level)=$row;
        $_SESSION['Id']=$IdUser;
        $_SESSION['Nama']=$Nama;
        
        //Memisahkan Level setiap pekerja
        switch($Level)
        {
          case 1:
            $_SESSION['Level']=$Level;
            $_SESSION['JobDesc']="Teknisi";
            break;
          case 2:
            $_SESSION['Level']=$Level;
            $_SESSION['JobDesc']="Penanggung Jawab";
            break;
          case 3:
            $_SESSION['Level']=$Level;
            $_SESSION['JobDesc']="Pemilik";
            break;
        }
        echo $_SESSION['Id'];
        echo $_SESSION['Nama'];
        echo $_SESSION['Level'];
        echo $_SESSION['JobDesc'];
      }
    while($row=mysqli_fetch_row($hasil));
  }
  //Jika Username atau Password salah maka menampilkan pesan salah
  else
  {
    echo "<center><h1>USERNAME DAN PASSWORD SALAH</h1></center>";
  }
?>