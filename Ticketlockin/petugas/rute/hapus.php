<?php
session_start();
require 'function.php';

if (!isset($_SESSION["username"])) {
    echo "<script type=text/javascript> alert('maaf anda tidak ada akses untuk mengakses menu!'); </script>
    window.location='../../auth/login/index.php'";
}

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script type=text/javascript> alert('data berhasil di hapus');
    window.location='index.php' </script>
    ";
} else {
    echo "<script type=text/javascript> alert('data gagal di hapus'); 
    window.location='index.php'</script>
    ";
}
