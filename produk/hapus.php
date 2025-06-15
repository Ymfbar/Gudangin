<?php
include('../auth/check_login.php');
include('../config/db.php');

$id = (int) $_GET['id'];
mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
header("Location: index.php");
