<?php
require 'function.php';
require '../../layouts/sidebar_petugas.php';

// Check if user is logged in
// if (!isset($_SESSION['id_user'])) {
//     header("Location: auth/login/");
//     exit;
// }

// $id_user = $_SESSION['id_user'];

// Get all transactions for the current user
$transactions = query("SELECT 
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
ORDER BY ot.tanggal_transaksi DESC");
?>


<div class="p-4 sm:ml-64">

    <div class="container mx-auto  ">
        <h1 class="text-3xl font-bold text-center mb-6">Riwayat Transaksi</h1>

        <?php if (empty($transactions)): ?>
            <div class="text-center text-gray-600">
                <p>Belum ada riwayat transaksi.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto rounded-lg flex">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-4 text-left">No</th>
                            <th class="py-3 px-4 text-left">ID Order</th>
                            <th class="py-3 px-4 text-left">Tanggal Transaksi</th>
                            <th class="py-3 px-4 text-left">Maskapai</th>
                            <th class="py-3 px-4 text-left">Rute</th>
                            <th class="py-3 px-4 text-left">Tanggal Pergi</th>
                            <th class="py-3 px-4 text-left">Waktu</th>
                            <th class="py-3 px-4 text-center">Jumlah Tiket</th>
                            <th class="py-3 px-4 text-right">Total Harga</th>
                            <th class="py-3 px-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4"><?= $no++; ?></td>
                                <td class="py-3 px-4"><?= $transaction['id_order']; ?></td>
                                <td class="py-3 px-4"><?= date('d/m/Y', strtotime($transaction['tanggal_transaksi'])); ?></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <?php if ($transaction['foto_maskapai']): ?>
                                            <img src="../../image/maskapai/<?= $transaction['foto_maskapai']; ?>"
                                                alt="<?= $transaction['nama_maskapai']; ?>"
                                                class="w-8 h-8 mr-2">
                                        <?php endif; ?>
                                        <?= $transaction['nama_maskapai']; ?>
                                    </div>
                                </td>
                                <td class="py-3 px-4"><?= $transaction['rute_asal']; ?> - <?= $transaction['rute_tujuan']; ?></td>
                                <td class="py-3 px-4"><?= date('d/m/Y', strtotime($transaction['tanggal_go'])); ?></td>
                                <td class="py-3 px-4">
                                    <?= date('H:i', strtotime($transaction['waktu_go'])); ?> -
                                    <?= date('H:i', strtotime($transaction['waktu_land'])); ?>
                                </td>
                                <td class="py-3 px-4 text-center"><?= $transaction['jumlah_tiket']; ?></td>
                                <td class="py-3 px-4 text-right">Rp <?= number_format($transaction['total_harga']); ?></td>
                                <td class="py-3 px-4">
                                    <?php if ($transaction['status'] === 'proses'): ?>
                                        <div class="text-yellow-600">
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                                Tiket kamu sedang di verifikasi oleh petugas
                                            </span>
                                        </div>
                                    <?php elseif ($transaction['status'] === 'terverivikasi'): ?>
                                        <div class="text-green-600">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                                Confirmed
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    @media print {

        nav,
        button {
            display: none !important;
        }

        .container {
            padding: 0 !important;
        }

        table {
            width: 100% !important;
        }
    }
</style>