<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  require 'functions.php';

  //ambil data di URL
  $id = $_GET["id"];

  // query data mahasiswa berdasarkan id
  $mhs = query("SELECT * FROM mahasiswa where id = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if (isset($_POST["submit"])) {

    // cek apakah data berhasi di ubah atau tidak
    if (ubah($_POST) > 0) {
      echo "
        <script>
          alert('data berhasil diubah');
          document.location.href = 'index.php';
        </script>
      ";
    }
    else {
      echo "<script>
        alert('data tidak ada yang diubah');
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
    <h1>Update data mahasiswa</h1>

    <form class="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $mhs["id"] ?>">
      <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
      <ul>
        <li>
          <label for="nim">NIM : </label>
          <input type="text" name="nim" id="nim" required value="<?= $mhs["nim"] ?>">
        </li>
        <li>
          <label for="nama">Nama : </label>
          <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"] ?>">
        </li>
        <li>
          <label for="email">Email : </label>
          <input type="email" name="email" id="email" required value="<?= $mhs["email"] ?>">
        </li>
        <li>
          <label for="jurusan">Jurusan : </label>
          <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"] ?>">
        </li>
        <li>
          <label for="gambar">Foto : </label> <br>
          <img src="img/<?= $mhs['gambar']?>" height="100" width="75"><br>
          <input type="file" name="gambar" id="gambar">
        </li>
        <li>
          <button type="submit" name="submit">Update Data</button>
        </li>
      </ul>
    </form>

  </body>
</html>
