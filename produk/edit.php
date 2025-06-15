<?php
include('../auth/check_login.php');
include('../config/db.php');

$id = (int) $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$data = mysqli_fetch_assoc($q);
if (!$data) {
    echo "Produk tidak ditemukan";
    exit;
}

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $id_kategori = (int) $_POST['kategori'];

    mysqli_query($conn, "UPDATE produk SET 
                         nama_produk='$nama', 
                         harga=$harga, 
                         id_kategori=$id_kategori 
                         WHERE id=$id");
    header("Location: index.php");
}
?>
<h2>Edit Produk</h2>
<form method="post">
  <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
  <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
  <select name="kategori" required>
    <option value="">-- Pilih Kategori --</option>
    <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
      <option value="<?= $k['id'] ?>" <?= $k['id'] == $data['id_kategori'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($k['nama_kategori']) ?>
      </option>
    <?php endwhile; ?>
  </select>
  <button type="submit">Update</button>
</form>
<a href="index.php">← Kembali</a>
