<?php
session_start();

if (isset($_GET['id'])) {
    $id_jadwal = $_GET['id'];

    // Hapus item dari cart berdasarkan id_jadwal
    if (isset($_SESSION['cart'][$id_jadwal])) {
        unset($_SESSION['cart'][$id_jadwal]);
    }
}

header('Location: cart.php'); // Balikin ke halaman cart kamu
exit;
