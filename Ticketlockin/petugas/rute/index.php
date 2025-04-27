<?php
session_start();
require 'function.php';


$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai ORDER BY rute_asal");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</head>

<body>
    <?php require '../../layouts/sidebar_petugas.php' ?>
    <div class="p-4 sm:ml-64">
        <p>hi admin <?= $_SESSION['nama_lengkap'] ?> ini halaman data rute</p>
        <div class="flex justify-end">

            <a href="tambah.php" class="font-semibold text-white bg-green-500 rounded-md px-5 py-2 my-5">+ Tambah </a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full  ">
                <tr class="bg-[#225270] text-white">

                    <th class="p-2 text-center">No</th>
                    <th class="p-2 text-center">Foto Maskapai</th>
                    <th class="p-2 text-center">Nama Maskapai</th>
                    <th class="p-2 text-center">Rute Asal</th>
                    <th class="p-2 text-center">Rute Tujuan</th>
                    <th class="p-2 text-center">Tanggal Pergi</th>
                    <th class="p-2 text-center">Action</th>

                </tr>
                <?php $no = 1; ?>
                <?php foreach ($rute as $r): ?>
                    <tr class="bg-gray-300 ">

                        <td class="p-3 text-center"><?= $no ?></td>
                        <td class="p-3 text-center">
                            <div class="flex justify-center">
                                <img class="w-24 h-24 object-cover" src="../../image/maskapai/<?= $r["foto_maskapai"] ?>" alt="">
                            </div>
                        </td>
                        <td class="p-3 text-center"><?= $r["nama_maskapai"] ?></td>
                        <td class="p-3 text-center"><?= $r["rute_asal"] ?></td>
                        <td class="p-3 text-center"><?= $r["rute_tujuan"] ?></td>
                        <td class="p-3 text-center"><?= $r["tanggal_go"] ?></td>
                        <td class="p-3 text-center ">
                            <div class="flex gap-4 justify-center">
                                <a href="edit.php?id=<?= $r["id_rute"] ?>" class="font-semibold text-white bg-blue-400 rounded-md px-5 py-2">Edit</a>
                                <a href="hapus.php?id=<?= $r["id_rute"] ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ini?')" class="font-semibold text-white bg-red-400 rounded-md px-5 py-2">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++ ?>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</body>

</html>