<?php
  usleep(300000);
  require '../functions.php';
  $keyword = $_GET["keyword"];

  $query = "SELECT * FROM jenis_barang WHERE
  nama_jenis LIKE '%$keyword%' OR
  kategori LIKE '%$keyword%'";
  $mahasiswa = query($query);

?>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Jenis barang</th>
            <th scope="col">Kategori</th>                                
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach($jenis_barang as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_jenis"] ?></td>
            <td><?= $row["kategori"] ?></td>
            <td>
                <a href="ubahjenis.php?id=<?= $row["id"]?>" class="badge bg-warning"><span data-feather="edit"></span></a>
                <a href="hapusjenis.php?id=<?= $row["id"]?>" onclick="return confirm('Apa anda yakin?')" class="badge bg-danger"><span data-feather="x-circle"></span></a>
            </td>
        </tr>                   
        <?php $i++; ?> 
        <?php endforeach; ?>
    </tbody>
</table>

