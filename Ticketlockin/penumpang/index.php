<?php
session_start();
require '../layouts/navbar.php';

$jadwal = query("SELECT * FROM jadwal_penerbangan 
INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai ORDER BY tanggal_go, waktu_go");
?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Jadwal Penerbangan</h1>
    <hr>
    <!-- Grid responsif: 1 kolom pada layar kecil, 2 pada sm, dan 4 kolom pada layar lg -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-5">
        <?php foreach ($jadwal as $data) : ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-4">
                    <!-- Top Section: Logo dan Tanggal -->
                    <div class="flex justify-between items-center border-b pb-2">
                        <img src="../image/maskapai/<?= $data["foto_maskapai"] ?>" alt="<?= $data['nama_maskapai']; ?>" class="w-16 h-16 object-contain">
                        <p class="text-sm text-gray-500"><?= date('d M Y', strtotime($data['tanggal_go'])) ?></p>
                    </div>
                    <!-- Middle Section: Informasi Penerbangan -->
                    <div class="mt-4">
                        <h2 class="text-xl font-semibold"><?= $data['nama_maskapai']; ?></h2>
                        <p class="text-gray-600 mt-1"><?= $data['waktu_go'] ?> - <?= $data['waktu_land'] ?></p>
                        <p class="text-gray-600 mt-1"><?= $data['rute_asal'] ?> - <?= $data['rute_tujuan'] ?></p>
                    </div>
                    <!-- Bottom Section: Harga dan Tombol Detail -->
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-blue-600 font-bold text-lg">Rp <?= number_format($data['harga']); ?></span>
                        <a href="detail.php?id=<?= $data['id_jadwal'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors duration-300">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>