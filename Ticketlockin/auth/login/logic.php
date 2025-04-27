<?php

require '../../koneksi.php';

// deklarasiin data data yang di post dari login pager 
$email = $_POST["email"];
$password = $_POST["password"];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' and password = '$password'");

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_array($query);

    if ($data["roles"] == "penumpang") {
        session_start();
        $_SESSION["nama_lengkap"] = $data["nama_lengkap"];
        $_SESSION["id_user"] = $data["id_user"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["roles"] = $data["roles"];

        header("Location:../../penumpang/index.php");
    } else if ($data["roles"] == "petugas") {
        session_start();
        $_SESSION["nama_lengkap"] = $data["nama_lengkap"];
        $_SESSION["id_user"] = $data["id_user"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["roles"] = $data["roles"];

        header("Location:../../petugas/dashboard.php");
    } else if ($data["roles"] == "admin") {
        session_start();
        $_SESSION["nama_lengkap"] = $data["nama_lengkap"];
        $_SESSION["id_user"] = $data["id_user"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["roles"] = $data["roles"];

        header("Location:../../admin/dashboard.php");
    }
} else {
    echo "<script type='text/javascript'> 
    alert('Data anda tidak di temukan di sistem kami, silahkan cek kembali data yang anda masukkan !');
    window.location='index.php';
    </script>";
}
