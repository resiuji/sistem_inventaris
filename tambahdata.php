<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
 
  require 'functions.php';

  $jenis_barang = query("SELECT * FROM jenis_barang");

  // cek apakah tombol submit sudah ditekan atau belum
  if (isset($_POST["submit"])) {

    // cek apakah data berhasi di tambah atau tidak
    if (tambahData($_POST) > 0) {
      echo "
        <script>
          alert('DATA DETAIL BARANG BERHASIL DITAMBAHKAN');
          document.location.href = 'index.php';
        </script>
      ";
    }
    else {
      echo "<script>
        alert('DATA DETAIL BARANG GAGAL DITAMBAHKAN');
        document.location.href = 'index.php';
      </script>
      ";
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Tambah Data Detail Barang</title>
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
                    <a class="nav-link active" href="detail.php">
                    <span data-feather="clipboard"></span>
                    Detail Barang
                    </a>
                </li>
              </ul>
            </div>
          </nav>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Tambah Detail Barang</h1>
            </div>
            <form method="POST" class="mt-3 mb-5">
              <div class="mb-3">
                  <label for="kategori" class="form-label">Kode Barang</label>
                  <input type="text" class="form-control" id="kode" name="kode" required>
                  <div id="emailHelp" class="form-text">Contoh : k0001, m0001</div>
              </div>
              <div class="mb-3">
                  <label for="jenis_barang" class="form-label">Jenis Barang</label>
                  <select class="form-select" name="id_jenis" required>
                      <?php foreach ($jenis_barang as $row) : ?>
                      <option value="<?= $row["id"]?>"><?= $row["nama_jenis"]; ?></option>
                      <?php endforeach ?>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="merk" class="form-label">Merk</label>
                  <input type="text" class="form-control" id="merk" name="merk">
                  <div id="emailHelp" class="form-text">Boleh dikosongkan jika tidak ada</div>
              </div>
              <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea class="form-control" rows="2" name="deskripsi" required></textarea>
                  <div id="emailHelp" class="form-text">Boleh dikosongkan jika tidak ada</div>
              </div>
              <div class="mb-3">
                  <label for="kondisi" class="form-label">Kondisi</label>
                  <select class="form-select" name="kondisi">
                      <option value="1">Baik</option>
                      <option value="0">Rusak</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              <a href="detail.php" class="btn btn-warning mx-3">Batal</a>
            </form>
          </main>
        </div>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    
    <script src="js/dashboard.js"></script>

  </body>
</html>
