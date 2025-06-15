<?php
include('../auth/check_login.php');
include('../config/db.php');

// Mengambil ID dari URL
$id = (int)$_GET['id'];
$q_produk = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$data = mysqli_fetch_assoc($q_produk);

// Jika produk tidak ditemukan, arahkan kembali
if (!$data) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data produk tidak ditemukan.'];
    header("Location: index.php");
    exit;
}

// Mengambil semua data kategori untuk dropdown
$q_kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Logika untuk memproses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $id_kategori = (int) $_POST['kategori'];

    $query = "UPDATE produk SET 
              nama_produk='$nama', 
              harga=$harga, 
              id_kategori=$id_kategori 
              WHERE id=$id";
    
    if(mysqli_query($conn, $query)) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Produk berhasil diperbarui.'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal memperbarui produk.'];
    }

    header("Location: index.php");
    exit;
}

include('../templates/header.php');
?>

<a href="index.php" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<h2>Edit Produk</h2>
<hr>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" value="<?= $data['harga'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" class="form-select" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php while ($k = mysqli_fetch_assoc($q_kategori)) : ?>
                        <option value="<?= $k['id'] ?>" <?= $k['id'] == $data['id_kategori'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($k['nama_kategori']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i> Update
            </button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php 
include('../templates/footer.php'); 
?>