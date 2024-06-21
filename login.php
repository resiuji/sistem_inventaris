<?php
  session_start();
  require 'functions.php';

  // cek cookie
  if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
    }
  }

  if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }


  if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users
      WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
      
      // cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        
        // set session
        $_SESSION["login"] = true;
        $_SESSION["nama"] = $row["nama"];
        $_SESSION["as"] = "User";
        if ($row["is_admin"] == 1) {
          $_SESSION["as"] = "Admin";
        }

        // cek remember me
        if (isset($_POST['remember'])) {
          // buat cookie
          setcookie('id', $row['id'], time() + 60);
          setcookie('key', hash('sha256', $row['username']), time() + 60);
        }

        header("Location: index.php");
        exit;
      }
    }

    $error = true;
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .container {
        margin: auto;
      }

    </style>

  </head>
  <body>
    <?php if (isset($error)): ?>
      <div class="alert alert-danger text-center" role="alert">
        Username atau password salah!
      </div>
    <?php endif; ?>
    
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5 bg-info p-5">
          <h1 class="text-center mb-5">SISTEM INVENTARIS</h1>
          <form method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary mb-3" name="login">Login</button>
            <p>Belum punya akun? </p>
            <a href="registrasi.php" class="btn btn-success"> Daftar Sekarang!</a>
          </form>
        </div>
      </div>
    </div>
    
  </body>
</html>

