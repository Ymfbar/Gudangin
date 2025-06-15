<?php
include('../auth/check_login.php');
include('../config/db.php');

// Mengambil ID dari URL dan memastikan itu adalah integer
$id = (int)$_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
$data = mysqli_fetch_assoc($q);

// Jika data dengan ID tersebut tidak ada, kembali ke halaman index
if (!$data) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data kategori tidak ditemukan.'];
    header("Location: index.php");
    exit;
}

// Logika untuk memproses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    
    // Query untuk update data
    $query = "UPDATE kategori SET nama_kategori='$nama' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Kategori berhasil diperbarui.'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal memperbarui kategori.'];
    }
    
    header("Location: index.php");
    exit;
}

include('../templates/header.php');
?>

<a href="index.php" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<h2>Edit Kategori</h2>
<hr>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($data['nama_kategori']) ?>" required>
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