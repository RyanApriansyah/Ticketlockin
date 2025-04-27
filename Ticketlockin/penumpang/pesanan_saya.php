<?php
session_start();
require 'function.php';
require '../layouts/navbar.php';

// Check if admin is logged in
// if (!isset($_SESSION['username']) || $_SESSION['roles'] !== 'Admin') {
//     header("Location: ../../auth/login/");
//     exit;
// }



// Get active tab
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';

// Prepare query based on active tab


// Get orders
$orders = query("SELECT 
    ot.id_order,
    ot.tanggal_transaksi,
    ot.status,
    od.jumlah_tiket,
    od.total_harga,
    u.nama_lengkap as nama_penumpang,
    jp.waktu_go,
    jp.waktu_land,
    r.rute_asal,
    r.rute_tujuan,
    r.tanggal_go,
    m.nama_maskapai,
    m.foto_maskapai
FROM order_tiket ot
INNER JOIN order_detail od ON ot.id_order = od.id_order
INNER JOIN users u ON od.id_user = u.id_user
INNER JOIN jadwal_penerbangan jp ON od.id_penerbangan = jp.id_jadwal
INNER JOIN rute r ON jp.id_rute = r.id_rute
INNER JOIN maskapai m ON r.id_maskapai = m.id_maskapai
WHERE status = 'proses'
ORDER BY ot.tanggal_transaksi DESC");
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="mb-4">
            <h2 class="text-2xl font-bold">Daftar Order Tiket</h2>
        </div>



        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">ID Order</th>
                        <th scope="col" class="px-6 py-3">Tanggal Transaksi</th>
                        <th scope="col" class="px-6 py-3">Nama Penumpang</th>
                        <th scope="col" class="px-6 py-3">Maskapai</th>
                        <th scope="col" class="px-6 py-3">Rute</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pergi</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3">Jumlah Tiket</th>
                        <th scope="col" class="px-6 py-3">Total Harga</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr class="bg-white border-b">
                            <td colspan="12" class="px-6 py-4 text-center">Tidak ada data order</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($orders as $order): ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4"><?= $no++; ?></td>
                                <td class="px-6 py-4"><?= $order['id_order']; ?></td>
                                <td class="px-6 py-4"><?= date('d/m/Y', strtotime($order['tanggal_transaksi'])); ?></td>
                                <td class="px-6 py-4"><?= $order['nama_penumpang']; ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <?php if ($order['foto_maskapai']): ?>
                                            <img src="../image/maskapai/<?= $order['foto_maskapai']; ?>"
                                                alt="<?= $order['nama_maskapai']; ?>"
                                                class="w-8 h-8 mr-2">
                                        <?php endif; ?>
                                        <?= $order['nama_maskapai']; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><?= $order['rute_asal']; ?> - <?= $order['rute_tujuan']; ?></td>
                                <td class="px-6 py-4"><?= date('d/m/Y', strtotime($order['tanggal_go'])); ?></td>
                                <td class="px-6 py-4">
                                    <?= date('H:i', strtotime($order['waktu_go'])); ?> -
                                    <?= date('H:i', strtotime($order['waktu_land'])); ?>
                                </td>
                                <td class="px-6 py-4"><?= $order['jumlah_tiket']; ?></td>
                                <td class="px-6 py-4">Rp <?= number_format($order['total_harga']); ?></td>
                                <td class="px-6 py-4">
                                    <?php if ($order['status'] === 'proses'): ?>
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Proses
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Terverifikasi
                                        </span>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>