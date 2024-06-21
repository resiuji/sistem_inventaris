<?php
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }

  require 'functions.php';

  $jumlah_jenis = query("SELECT COUNT(*) as jumlah FROM jenis_barang");
  $jumlah_detail = query("SELECT COUNT(*) as jumlah FROM detail_barang");
  $jumlah_baik = query("SELECT COUNT(*) as jumlah FROM detail_barang WHERE kondisi=1");
  $jumlah_rusak = query("SELECT COUNT(*) as jumlah FROM detail_barang WHERE kondisi=0");

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>

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
                                <a class="nav-link active" aria-current="page" href="index.php">
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
                        <div class="mt-4 hidden" style="border-top: 1px solid grey;">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Administrator</span>
                            </h6>
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="akun.php">
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
                        <h1 class="h2">Welcome, <?=$_SESSION["nama"]; ?> (<?= $_SESSION["as"]; ?>) </h1>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                        <div class="col">
                            <div class="card" style="width: 26rem;">
                                <a href="jenisbarang.php" class="text-decoration-none text-black">
                                    <img src="img/jenis1.jpg" class="card-img-top opacity-75" alt="..." height="220px">
                                    <div class="card-img-overlay d-flex align-items-center p-0 mt-3">
                                        <h5 class="card-title text-center flex-fill p-3 fs-4" style="background-color: rgba(255, 102, 79, 0.7)">Jumlah Jenis Barang : <?= $jumlah_jenis[0]["jumlah"] ?></h5>
                                    </div>
                                </a>                            
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 26rem;">
                                <a href="detail.php" class="text-decoration-none text-black">
                                    <img src="img/detail.jpg" class="card-img-top opacity-75" alt="..." height="220px">
                                    <div class="card-img-overlay d-flex align-items-center p-0 mt-3">
                                        <h5 class="card-title text-center flex-fill p-3 fs-4" style="background-color: rgba(255, 102, 79, 0.7)">Jumlah Detail Barang : <?= $jumlah_detail[0]["jumlah"] ?></h5>
                                    </div>
                                </a>                            
                            </div>
                        </div>
                        <div class="col mt-5">
                            <div class="card" style="width: 26rem;">
                                <a href="detail.php?keyword=baik&cariDetail=" class="text-decoration-none text-black">
                                    <img src="img/baik.jpg" class="card-img-top opacity-75" alt="..." height="220px">
                                    <div class="card-img-overlay d-flex align-items-center p-0 mt-3">
                                        <h5 class="card-title text-center flex-fill p-3 fs-4" style="background-color: rgba(255, 102, 79, 0.7)">Jumlah Barang Kondisi Baik : <?= $jumlah_baik[0]["jumlah"] ?></h5>
                                    </div>
                                </a>                            
                            </div>
                        </div>
                        <div class="col mt-5">
                            <div class="card" style="width: 26rem;">
                                <a href="detail.php?keyword=rusak&cariDetail=" class="text-decoration-none text-black">
                                    <img src="img/rusak2.jpg" class="card-img-top opacity-75" alt="..." height="220px">
                                    <div class="card-img-overlay d-flex align-items-center p-0 mt-3">
                                        <h5 class="card-title text-center flex-fill p-3 fs-4" style="background-color: rgba(255, 102, 79, 0.7)">Jumlah Barang Kondisi Rusak : <?= $jumlah_rusak[0]["jumlah"] ?></h5>
                                    </div>
                                </a>                            
                            </div>
                        </div>
                    </div>
                    
                </main>
            </div>
        </div>


        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        
        <script src="js/dashboard.js"></script>

        <script src="js/jquery-3.6.0.min.js"></script>
        
        <?php 
        if ($_SESSION["as"] == "User") { ?>
            <script>$(document).ready(function() {
                $('.hidden').hide();
              });
            </script>
        <?php } ?>

    </body>
</html>
