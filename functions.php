<?php
  // Koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "inventaris");

  function query($query)
  {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

  function tambahJenis($data) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $nama_jenis = htmlspecialchars($data["nama_jenis"]);
    $kategori = htmlspecialchars($data["kategori"]);

    // query insert data
    $query = "INSERT INTO jenis_barang values('',
          '$nama_jenis',
          '$kategori')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function tambahData($data) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $kode = htmlspecialchars($data["kode"]);
    $id_jenis = $data["id_jenis"];
    $merk = htmlspecialchars($data["merk"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $kondisi = $data["kondisi"];

    // query insert data
    $query = "INSERT INTO detail_barang values('',
          '$kode',
          '$id_jenis',
          '$merk',
          '$deskripsi',
          '$kondisi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function hapusDetail($id)
  {
    global $conn;
    mysqli_query($conn, "DELETE FROM detail_barang WHERE id = $id");
    return mysqli_affected_rows($conn);
  }

  function hapusJenis($id)
  {
    global $conn;
    mysqli_query($conn, "DELETE FROM jenis_barang WHERE id = $id");
    return mysqli_affected_rows($conn);
  }

  function hapusAkun($id)
  {
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    return mysqli_affected_rows($conn);
  }

  function ubahDetail($data)
  {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $kode = htmlspecialchars($data["kode"]);
    $id_jenis = $data["id_jenis"];
    $merk = htmlspecialchars($data["merk"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $kondisi = $data["kondisi"];

    // query insert data
    $query = "UPDATE detail_barang SET
              kode = '$kode',
              id_jenis = '$id_jenis',
              merk = '$merk',
              deskripsi = '$deskripsi',
              kondisi = '$kondisi'
              WHERE id = $id
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function ubahJenis($data)
  {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $nama_jenis = htmlspecialchars($data["nama_jenis"]);
    $kategori = htmlspecialchars($data["kategori"]);

    // query insert data
    $query = "UPDATE jenis_barang SET
              nama_jenis = '$nama_jenis',
              kategori = '$kategori'
              WHERE id = $id
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function cariAkun($keyword)
  {
    if ($keyword == "admin") {
      $query = "SELECT * FROM users WHERE
      is_admin=1 OR
      email LIKE '%$keyword%' OR
      username LIKE '%$keyword%' OR
      nama LIKE '%$keyword%'";
      return query($query);
    } elseif ($keyword == "user") {
      $query = "SELECT * FROM users WHERE
      is_admin=0 OR
      email LIKE '%$keyword%' OR
      username LIKE '%$keyword%' OR
      nama LIKE '%$keyword%'";
      return query($query);
    } else {
      $query = "SELECT * FROM users WHERE
      email LIKE '%$keyword%' OR
      username LIKE '%$keyword%' OR
      nama LIKE '%$keyword%'";
      return query($query);
    }
  }

  function cariJenis($keyword)
  {
    $query = "SELECT * FROM jenis_barang WHERE
    nama_jenis LIKE '%$keyword%' OR
    kategori LIKE '%$keyword%'";
    return query($query);   
  }

  function cariDetail($keyword)
  {
    if ($keyword == "rusak") {
      $query = "SELECT 
      detail_barang.id, 
      detail_barang.kode, 
      jenis_barang.nama_jenis, 
      detail_barang.merk, 
      detail_barang.deskripsi, 
      detail_barang.kondisi
      FROM detail_barang
      INNER JOIN jenis_barang 
      ON detail_barang.id_jenis=jenis_barang.id 
      WHERE
      kondisi=0";
      return query($query);
    } elseif ($keyword == "baik") {
      $query = "SELECT 
      detail_barang.id, 
      detail_barang.kode, 
      jenis_barang.nama_jenis, 
      detail_barang.merk, 
      detail_barang.deskripsi, 
      detail_barang.kondisi
      FROM detail_barang
      INNER JOIN jenis_barang 
      ON detail_barang.id_jenis=jenis_barang.id 
      WHERE
      kondisi=1";
      return query($query);
    } else {
      $query = "SELECT 
      detail_barang.id, 
      detail_barang.kode, 
      jenis_barang.nama_jenis, 
      detail_barang.merk, 
      detail_barang.deskripsi, 
      detail_barang.kondisi
      FROM detail_barang
      INNER JOIN jenis_barang 
      ON detail_barang.id_jenis=jenis_barang.id 
      WHERE
      kode LIKE '%$keyword%' OR
      nama_jenis LIKE '%$keyword%' OR
      merk LIKE '%$keyword%' OR
      deskripsi LIKE '%$keyword%' OR
      kondisi LIKE '%$keyword%'";
      return query($query);
    }    
  }

  function registrasi($data)
  {
    global $conn;
    $email = $data["email"];
    $username = strtolower(stripslashes($data["username"]));
    $nama = $data["nama"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result) ) {
      echo "<script>
              alert('username sudah terdaftar');
            </script>";
      return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
      echo "<script>
              alert('Konfirmasi password tidak sesuai');
            </script>";
      return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES
      ('', '$email', '$username',  '$password', '$nama', 0)");

    return mysqli_affected_rows($conn);
    echo "<script>
            alert('REGISTRASI BERHASIL !');
          </script>";

  }

  function tambahAdmin($data)
  {
    global $conn;
    $email = $data["email"];
    $username = strtolower(stripslashes($data["username"]));
    $nama = $data["nama"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result) ) {
      echo "<script>
              alert('username sudah terdaftar');
            </script>";
      return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
      echo "<script>
              alert('Konfirmasi password tidak sesuai');
            </script>";
      return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES
      ('', '$email', '$username',  '$password', '$nama', 1)");

    return mysqli_affected_rows($conn);

  }


?>
