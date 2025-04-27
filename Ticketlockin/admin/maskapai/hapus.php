<?php
session_start();
require 'function.php';
if (!isset($_SESSION["username"])) {
    echo "<script type='text/javascript'> alert('anda tidak mempunyai akses untuk masuk ke halaman ini !');
    window.location='../../auth/login/index.php'; </script>
   ";
}

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script type='text/javascript'> alert('data berhasil dihapus');
    window.location='index.php'; </script>
   ";
} else {
    echo "<script type='text/javascript'> alert('data gagal dihapus');
    window.location='index.php'; </script>
   ";
}
