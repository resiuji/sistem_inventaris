<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  
  require 'functions.php';

  $id = $_GET["id"];

  if (hapusJenis($id) > 0) {
    echo "
      <script>
        alert('DATA JENIS BARANG BERHASIL DIHAPUS');
        document.location.href = 'jenisbarang.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('DATA JENIS BARANG GAGAL DIHAPUS');
        document.location.href = 'jenisbarang.php';
      </script>
    ";
  }
?>
