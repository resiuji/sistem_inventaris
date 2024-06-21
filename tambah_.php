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
    if (tambah($_POST) > 0) {
      echo "
        <script>
          alert('data berhasil ditambahkan');
          document.location.href = 'index.php';
        </script>
      ";
    }
    else {
      echo "<script>
        alert('data gagal ditambahkan');
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
    <title></title>
  </head>
  <body>
    <h1>Tambah data mahasiswa</h1>

    <form class="" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label for="nim">NIM : </label>
          <input type="text" name="nim" id="nim" required>
        </li>
        <li>
          <label for="nama">Nama : </label>
          <input type="text" name="nama" id="nama" required>
        </li>
        <li>
          <label for="email">Email : </label>
          <input type="email" name="email" id="email" required>
        </li>
        <li>
          <label for="jurusan">Jurusan : </label>
          <input type="text" name="jurusan" id="jurusan" required>
        </li>
        <li>
          <label for="gambar">Foto : </label>
          <input type="file" name="gambar" id="gambar">
        </li>
        <li>
          <button type="submit" name="submit">Tambah Data</button>
        </li>
      </ul>
    </form>

  </body>
</html>
