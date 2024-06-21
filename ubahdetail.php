<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  require 'functions.php';

  $jenis_barang = query("SELECT * FROM jenis_barang");

  //ambil data di URL
  $id = $_GET["id"];

  // query data mahasiswa berdasarkan id
  $detail = query("SELECT * FROM detail_barang where id = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if (isset($_POST["submit"])) {

    // cek apakah data berhasi di ubah atau tidak
    if (ubahDetail($_POST) > 0) {
      echo "
        <script>
          alert('DATA DETAIL BARANG BERHASIL DIUBAH');
          document.location.href = 'detail.php';
        </script>
      ";
    }
    else {
      echo "<script>
        alert('DATA DETAIL BARANG GAGAL DIUBAH');
        document.location.href = 'detail.php';
      </script>
      ";
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ubah Data Detail Barang</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
            <h1 class="h2">Ubah Detail Barang</h1>
          </div>
          <form class="mb-5" method="post">
            <input type="hidden" name="id" value="<?= $detail["id"] ?>">
            <div class="mb-3">
              <label for="kategori" class="form-label">Kode Barang</label>
              <input type="text" class="form-control" id="kode" name="kode" value="<?=$detail["kode"] ?>" required>
              <div id="emailHelp" class="form-text">Contoh : k0001, m0001</div>
            </div>
            <div class="mb-3">
              <label for="jenis_barang" class="form-label">Jenis Barang</label>
              <select class="form-select" name="id_jenis" required>
                <?php foreach ($jenis_barang as $row) : 
                  if ($detail["id_jenis"] == $row["id"]) { ?>
                    <option value="<?= $row["id"]?>" selected><?= $row["nama_jenis"]; ?></option>
                  <?php }
                  else { ?>
                    <option value="<?= $row["id"]?>"><?= $row["nama_jenis"]; ?></option>
                  <?php } ?>
                <?php endforeach ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="merk" class="form-label">Merk</label>
              <input type="text" class="form-control" id="merk" name="merk" value="<?=$detail["merk"] ?>">
              <div id="emailHelp" class="form-text">Boleh dikosongkan jika tidak ada</div>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" rows="2" name="deskripsi"  required><?=$detail["deskripsi"] ?></textarea>
              <div id="emailHelp" class="form-text">Boleh dikosongkan jika tidak ada</div>
            </div>
            <div class="mb-3">
              <label for="kondisi" class="form-label">Kondisi</label>
              <select class="form-select" name="kondisi">
                <?php if ($detail["kondisi"] == '1') { ?>
                  <option value="1">Baik</option>
                <?php } 
                else { ?>
                  <option value="0">Rusak</option>
                <?php }?>                  
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
