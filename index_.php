<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }

  require 'functions.php';
  $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

  // tombol cari ditekan
  if (isset ($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Halaman Admin</title>
    <style media="screen">
      .loader {
        width: 70px;
        position: absolute;
        top: 117px;
        left: 260px;
        z-index: -1;
        display: none;
      }
      @media print {
        .logout, .tambah, .form-cari {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php">Cetak</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php" class="tambah">Tambah Data Mahasiswa</a> <br><br>

    <form class="form=cari" action="" method="post">
      <input type="text" name="keyword" value="" size="40" autofocus
      placeholder="Masukkan keyword pencarian.." autocomplete="off"
      id="keyword">
      <button type="submit" name="cari" id="tombol-cari">Cari</button>

      <img src="img/loader.gif" alt="" class="loader">
    </form>
    <br>

    <div class="" id="container">

      <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach($mahasiswa as $row) : ?>

      <tr>
        <td><?= $i; ?></td>
        <td>
          <a href="ubah.php?id=<?= $row["id"]?>">Ubah</a> |
          <a href="hapus.php?id=<?= $row["id"]?>" onclick="return confirm('Apa anda yakin?')">Hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"] ?>" height="150" width="100"></td>
        <td><?= $row["nim"] ?></td>
        <td><?= $row["nama"] ?></td>
        <td><?= $row["email"] ?></td>
        <td><?= $row["jurusan"] ?></td>
      </tr>

        <?php $i++; ?>
      <?php endforeach; ?>
      </table>

    </div>

    <script src="js/jquery-3.6.0.min.js" charset="utf-8"></script>
    <script src="js/script.js" charset="utf-8"></script>
  </body>
</html>
