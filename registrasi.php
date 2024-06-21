<?php
  require 'functions.php';

    if (isset($_POST["register"])) {
      if (registrasi($_POST) > 0) {
        echo "
        <script>
          alert('REGISTRASI BERHASIL, SILAHKAN LOGIN');
          document.location.href = 'login.php';
        </script>";
      }
      else {
        echo mysqli_error($conn);
      }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    
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
    
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto px-5 py-4 bg-info">
          <h1 class="text-center mb-3">SISTEM INVENTARIS</h1>
          <h3 class="text-center mb-5">Registrasi</h3>
          <form method="POST">
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="col">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required> 
                </div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" name="password2" id="password2" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3" name="register">Register</button>
            <p>Sudah Punya Akun?</p> 
            <a href="login.php" class="btn btn-success">Login Sekarang!</a>
          </form>
        </div>
      </div>
    </div>
    
  </body>
</html>

