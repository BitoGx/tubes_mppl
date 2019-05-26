<?php
  // Initialize the session
  session_start();

/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: welcome.php");
    exit;
}*/

  //Memanggil fungsi untuk menyambungkan ke database
  require_once "php/connection.php";

  //Inisialisasi Username dan Password
  $username = $password = "";
  $username_err = $password_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // Check if username is empty
    if(empty(trim($_POST["username"])))
    {
      $username_err = "Please enter username.";
    } 
    else
    {
      $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"])))
    {
      $password_err = "Please enter your password.";
    } 
    else
    {
      $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
      // Prepare a select statement
      $sql = "SELECT IdUser, Username, password FROM user WHERE username = ?";
        
      if($stmt = mysqli_prepare($conn, $sql))
      {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
            
        // Set parameters
        $param_username = $username;
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt))
        {
          // Store result
          mysqli_stmt_store_result($stmt);
                
          // Check if username exists, if yes then verify password
          if(mysqli_stmt_num_rows($stmt) == 1)
          {                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            if(mysqli_stmt_fetch($stmt))
            {
              if(password_verify($password, $hashed_password))
              {
                // Password is correct, so start a new session
                session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;                            
                            
                // Redirect user to welcome page
                header("location: welcome.php");
              } 
              else
              {
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
              }
            }
          }
          else
          {
            // Display an error message if username doesn't exist
            $username_err = "No account found with that username.";
          }
        } 
        else
        {
          echo "Oops! Something went wrong. Please try again later.";
        }
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($conn);
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
          <form class="form" action="" method="post" name="login">
            <div class="form-group">
              <h3 class="login-header"><b>Masuk</b></h2>
            </div>
            <div class="form-group">
              <label>Nama Pengguna</label>
              <input type="text" name="username" placeholder="Masukan Akun" class="username-input form-control">
            </div>
            <div class="form-group">
              <label>Kata Sandi</label>
              <input type="password" name="password" placeholder="Masukan Kata Sandi" class="password-input form-control">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" name="remember" class="form-check-input"><span>Ingat saya</span>
            </div>
            <div class="form-group">
              <input type="submit" type="submit" name="submit" value="Masuk" class="btn btn-primary btn-block" onclick="return(submitlogin())">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
