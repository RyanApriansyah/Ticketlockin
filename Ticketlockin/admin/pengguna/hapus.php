<?php
session_start();
require 'function.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('anda tidak memiliki akses untuk mengakses menu ini !');
    window.location='../../auth/login/index.php'</script>";
}

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>alert('berhasil menghapus data');
    window.location='index.php'</script>";
} else {
    echo "<script>alert('gagal menghapus data!');
    window.location='index.php'</script>";
}
