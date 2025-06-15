<?php
include('../auth/check_login.php');
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: index.php");
}
?>
<h2>Tambah Kategori</h2>
<form method="post">
  <input type="text" name="nama" placeholder="Nama Kategori" required>
  <button type="submit">Simpan</button>
</form>
<a href="index.php">← Kembali</a>
