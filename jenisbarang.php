<?php
    session_start();
  
    if (!isset($_SESSION["login"])) {
      header("Location: login.php");
      exit;
    }

    require 'functions.php';

    $jenis_barang = query("SELECT * FROM jenis_barang ORDER BY nama_jenis ASC");
    
    $kata = "";
    // tombol cari ditekan
    if (isset ($_GET["cariJenis"])) {
        $jenis_barang = cariJenis($_GET["keyword"]);
        $kata = $_GET["keyword"];
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jenis Barang</title>

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
                                <a class="nav-link" aria-current="page" href="index.php">
                                <span data-feather="home"></span>
                                Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="jenisbarang.php">
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
                        <h1 class="h2">Data Jenis Barang</h1>
                    </div>

                    <div class="table-responsive col-lg-8">
                        <form class="d-flex mb-3" method="GET">
                            <input class="form-control me-2" type="search" name="keyword" value="<?=$kata; ?>" placeholder="Cari jenis barang atau kategori" >
                            <button class="btn btn-outline-success" type="submit" name="cariJenis">
                                <span data-feather="search"></span>
                            </button>
                        </form>

                        <a href="tambahjenis.php" class="hidden btn btn-primary mb-3">Tambah Jenis Barang</a>

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Jenis barang</th>
                                <th scope="col">Kategori</th>                                
                                <th scope="col" class="hidden">Action</th>                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($jenis_barang as $row) : ?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row["nama_jenis"] ?></td>
                                    <td><?= $row["kategori"] ?></td>
                                    <td class="hidden">
                                        <a href="ubahjenis.php?id=<?= $row["id"]?>" class="badge bg-warning text-decoration-none">Edit <span data-feather="edit"></span></a>
                                        <a href="hapusjenis.php?id=<?= $row["id"]?>" onclick="return confirm('Apa anda yakin?')" class="badge bg-danger text-decoration-none">Hapus <span data-feather="x-circle"></span></a>
                                    </td>
                                </tr>
                                
                                <?php $i++; ?> 
                                <?php endforeach; ?>

                            </tbody>
                        </table>
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
