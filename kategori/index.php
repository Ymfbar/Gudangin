<?php
include('../auth/check_login.php');
include('../config/db.php');

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>
<h2>Data Kategori</h2>
<a href="tambah.php">+ Tambah Kategori</a>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while ($row = mysqli_fetch_assoc($kategori)) : ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
    <td>
      <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
      <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
<a href="../index.php">← Kembali ke Dashboard</a>
