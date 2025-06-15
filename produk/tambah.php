<?php
include('../auth/check_login.php');
include('../config/db.php');

// Mengambil data kategori untuk dropdown
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Logika untuk memproses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $id_kategori = (int) $_POST['kategori'];

    $query = "INSERT INTO produk (nama_produk, harga, id_kategori) 
              VALUES ('$nama', $harga, $id_kategori)";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Produk berhasil ditambahkan.'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal menambahkan produk.'];
    }
    
    header("Location: index.php");
    exit;
}

// Memuat template header
include('../templates/header.php');
?>

<a href="index.php" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<h2>Tambah Produk Baru</h2>
<hr>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="e.g., Kopi Susu" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" placeholder="e.g., 25000" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" class="form-select" id="kategori" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                    <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php
// Memuat template footer
include('../templates/footer.php'); 
?>