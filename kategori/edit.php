<?php
include('../auth/check_login.php');
include('../config/db.php');

$id = $_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
$data = mysqli_fetch_assoc($kategori);

if (!$data) {
    echo "Kategori tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id=$id");
    header("Location: index.php");
}
?>
<h2>Edit Kategori</h2>
<form method="post">
  <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_kategori']) ?>" required>
  <button type="submit">Update</button>
</form>
<a href="index.php">← Kembali</a>
