<?php
session_start();
require 'function.php';

$id = $_GET["id"];
if (hapus($id) > 0) {
    echo "<script type='text/javascript'>alert('data berhasil dihapus');
    window.location='index.php'</script>";
} else {
    echo "<script type='text/javascript'>alert('data gagal dihapus');
    window.location='index.php'</script>";
}
