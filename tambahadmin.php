<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

  require 'functions.php';

  // cek apakah tombol submit sudah ditekan atau belum
  if (isset($_POST["submit"])) {

    // cek apakah data berhasi di tambah atau tidak
    if (tambahAdmin($_POST) > 0) {
      echo "
        <script>
          alert('DATA ADMIN BERHASIL DITAMBAHKAN');
          document.location.href = 'akun.php';
        </script>
      ";
    }
    else {
      echo mysqli_error($conn);
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
      </style>
      <!-- Custom styles for this template -->
      <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Sistem Inventaris</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link btn btn-danger px-3" href="logout.php">Sign out  <span data-feather="log-out"></span></a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">
                          <span data-feather="home"></span>
                          Dashboard
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="jenisbarang.php">
                          <span data-feather="database"></span>
                          Jenis Barang
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="detail.php">
                          <span data-feather="clipboard"></span>
                          Detail Barang
                          </a>
                      </li>
                    </ul>
                    <div class="mt-4" style="border-top: 1px solid grey;">
                      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Administrator</span>
                      </h6>
                      <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                          <a class="nav-link active" href="akun.php">
                              <span data-feather="file-text"></span>
                              Pengelolaan Akun
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tambah Admin</h1>
              </div>
              <form method="POST">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="password2" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="akun.php" class="btn btn-warning mx-3">Batal</a>
              </form>
            </main>
        </div>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    
    <script src="js/dashboard.js"></script>

  </body>
</html>
