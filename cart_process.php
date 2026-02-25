<?php
include 'config/database.php';
session_start();

// 1. Jika belum login, tendang ke folder auth/login.php
if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php?msg=login_to_purchase");
    exit;
}

// 2. Ambil ID dari URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Cek apakah sudah ada di tabel cart
    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");

    if (mysqli_num_rows($check) > 0) {
        // Update jumlah
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
    } else {
        // Tambah baru
        mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)");
    }

    // Ganti baris header di cart_process.php dengan logic ini:
   $referer = $_SERVER['HTTP_REFERER'];
   if (strpos($referer, '?') !== false) {
    header("Location: " . $referer . "&status=added");
    } else {
    header("Location: " . $referer . "?status=added");
    }
    exit;
} else {
    // Jika tidak ada ID, balik ke index
    header("Location: index.php");
    exit;
}
?>