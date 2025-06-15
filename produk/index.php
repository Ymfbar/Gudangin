<?php
include('../auth/check_login.php');
include('../config/db.php');

$q = mysqli_query($conn, "SELECT produk.*, kategori.nama_kategori 
                          FROM produk 
                          LEFT JOIN kategori ON produk.id_kategori = kategori.id");
?>
<h2>Data Produk</h2>
<a href="tambah.php">+ Tambah Produk</a>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Harga</th>
    <th>Kategori</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while ($row = mysqli_fetch_assoc($q)) : ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
    <td><?= htmlspecialchars($row['nama_kategori'] ?? '-') ?></td>
    <td>
      <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
      <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
<a href="../index.php">← Kembali ke Dashboard</a>
