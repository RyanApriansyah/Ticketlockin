
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

    $id_rute = htmlspecialchars($data["id_rute"]);
    $waktu_go = htmlspecialchars($data["waktu_go"]);
    $waktu_land = htmlspecialchars($data["waktu_land"]);
    $harga = htmlspecialchars($data["harga"]);
    $kap_kursi = htmlspecialchars($data["kap_kursi"]);

    $query = "INSERT INTO jadwal_penerbangan VALUES (NULL,'$id_rute','$waktu_go','$waktu_land','$harga','$kap_kursi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM jadwal_penerbangan WHERE id_jadwal = '$id'");
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id = htmlspecialchars($data["id_jadwal"]);
    $id_rute = htmlspecialchars($data["id_rute"]);
    $waktu_go = htmlspecialchars($data["waktu_go"]);
    $waktu_land = htmlspecialchars($data["waktu_land"]);
    $harga = htmlspecialchars($data["harga"]);
    $kap_kursi = htmlspecialchars($data["kap_kursi"]);

    $query = "UPDATE jadwal_penerbangan SET id_jadwal = '$id',id_rute = '$id_rute',waktu_go = '$waktu_go',waktu_land = '$waktu_land',harga = '$harga', kap_kursi = '$kap_kursi' WHERE id_jadwal = '$id'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
