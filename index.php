<?php
// index.php
session_start(); // Start the session if it hasn't been started already

if (!isset($_SESSION['login'])) { // Check if the user is not logged in
    header("Location: auth/login.php"); // Redirect to the login page
    exit;
}

include('auth/check_login.php'); // This will now only be included if the user is logged in
include('templates/header.php');
?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Gudangin</h1>
        <p class="col-md-8 fs-4">Selamat datang di sistem manajemen Gudangin. Kelola produk dan kategori Anda dengan mudah.</p>
    </div>
</div>

<div class="row text-center">
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm dashboard-card">
            <div class="card-body">
                <i class="bi bi-box-seam fs-1 text-primary"></i>
                <h5 class="card-title mt-3">Kelola Produk</h5>
                <p class="card-text">Tambah, lihat, edit, dan hapus data produk.</p>
                <a href="produk/index.php" class="btn btn-primary">Go to Products</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm dashboard-card">
            <div class="card-body">
                <i class="bi bi-tags fs-1 text-success"></i>
                <h5 class="card-title mt-3">Kelola Kategori</h5>
                <p class="card-text">Atur kategori untuk pengelompokan produk.</p>
                <a href="kategori/index.php" class="btn btn-success">Go to Categories</a>
            </div>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>