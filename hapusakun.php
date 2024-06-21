<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  
  require 'functions.php';

  $id = $_GET["id"];

  if (hapusAkun($id) > 0) {
    echo "
      <script>
        alert('DATA ADMIN BERHASIL DIHAPUS');
        document.location.href = 'akun.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('DATA ADMIN GAGAL DIHAPUS');
        document.location.href = 'akun.php';
      </script>
    ";
  }
?>
