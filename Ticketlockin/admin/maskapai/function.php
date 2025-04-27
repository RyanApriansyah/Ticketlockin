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
    $foto_maskapai = $_FILES["foto_maskapai"]["name"];
    $files = $_FILES["foto_maskapai"]["tmp_name"];
    $nama_maskapai = htmlspecialchars($data["nama_maskapai"]);

    $query = "INSERT INTO maskapai VALUES (NULL,'$foto_maskapai','$nama_maskapai')";

    move_uploaded_file($files, "../../image/maskapai/" . $foto_maskapai);

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM maskapai WHERE id_maskapai = $id");
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_maskapai"]);
    $foto_maskapai = $_FILES["foto_maskapai"]["name"];
    $files = $_FILES["foto_maskapai"]["tmp_name"];
    $nama_maskapai = htmlspecialchars($data["nama_maskapai"]);

    if (empty($foto_maskapai)) {
        $query = ("UPDATE maskapai SET nama_maskapai = '$nama_maskapai' where id_maskapai = '$id'");
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        $query = ("UPDATE maskapai SET  foto_maskapai = '$foto_maskapai', nama_maskapai = '$nama_maskapai' where id_maskapai = '$id'");
        move_uploaded_file($files, "../../image/maskapai/" . $foto_maskapai);
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}
