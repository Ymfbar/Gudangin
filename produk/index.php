<?php
include('../auth/check_login.php');
include('../templates/header.php'); // Menggunakan template header
include('../config/db.php');

// Query untuk mengambil data produk beserta nama kategorinya
$q = mysqli_query($conn, "SELECT produk.*, kategori.nama_kategori 
                          FROM produk 
                          LEFT JOIN kategori ON produk.id_kategori = kategori.id
                          ORDER BY produk.id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Data Produk</h2>
    <a href="tambah.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($q) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($q)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['nama_kategori'] ?? '-') ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data produk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="../index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>

<?php 
// Menggunakan template footer
include('../templates/footer.php'); 
?>