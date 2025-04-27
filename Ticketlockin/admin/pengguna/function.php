<?php
require '../../koneksi.php';

function query($query)
{
    global $conn;

    $rows = [];
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $roles = htmlspecialchars($data['roles']);
    $password = htmlspecialchars($data['password']);

    $query = "INSERT INTO users VALUES(NULL,'$nama_lengkap ','$username','$email','$roles','$password')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_user"]);
    $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $roles = htmlspecialchars($data["roles"]);
    $password = htmlspecialchars($data["password"]);

    $query = "UPDATE users SET nama_lengkap = '$nama_lengkap',username = '$username',email = '$email',roles='$roles',password = '$password' where id_user = '$id'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");
    return mysqli_affected_rows($conn);
}
