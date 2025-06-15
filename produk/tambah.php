<?php
include('../auth/check_login.php');
include('../config/db.php');

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $id_kategori = (int) $_POST['kategori'];

    mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, id_kategori) 
                         VALUES ('$nama', $harga, $id_kategori)");
    header("Location: index.php");
}
?>
<h2>Tambah Produk</h2>
<form method="post">
  <input type="text" name="nama" placeholder="Nama Produk" required>
  <input type="number" name="harga" placeholder="Harga" required>
  <select name="kategori" required>
    <option value="">-- Pilih Kategori --</option>
    <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
      <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
    <?php endwhile; ?>
  </select>
  <button type="submit">Simpan</button>
</form>
<a href="index.php">← Kembali</a>
