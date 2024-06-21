<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  
  require 'functions.php';

  $id = $_GET["id"];

  if (hapusDetail($id) > 0) {
    echo "
      <script>
        alert('DATA DETAIL BARANG BERHASIL DIHAPUS');
        document.location.href = 'detail.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('DATA DETAIL BARANG GAGAL DIHAPUS');
        document.location.href = 'detail.php';
      </script>
    ";
  }
?>
