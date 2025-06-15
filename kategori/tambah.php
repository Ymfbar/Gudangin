<?php
include('../auth/check_login.php');
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    
    $stmt = mysqli_prepare($conn, "INSERT INTO kategori (nama_kategori) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "s", $nama);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Kategori berhasil ditambahkan.'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal menambahkan kategori.'];
    }
    mysqli_stmt_close($stmt);
    
    header("Location: index.php");
    exit;
}

include('../templates/header.php');
?>

<h2>Tambah Kategori Baru</h2>
<hr>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="e.g., Makanan Ringan" required>
            </div>