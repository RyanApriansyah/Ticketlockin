<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';

if (!function_exists('query')) {
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
}
if (!function_exists('checkout')) {
    function checkout($data)
    {
        global $conn;

        try {
            // Enable error reporting for debugging
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            // Log data yang diterima untuk checkout
            error_log("Data yang diterima untuk checkout: " . print_r($data, true));

            // Start transaction
            mysqli_begin_transaction($conn);

            // Validate user ID exists
            if (!isset($data["id_user"]) || empty($data["id_user"])) {
                error_log("User ID tidak ditemukan atau kosong");
                throw new Exception("User ID is required");
            }

            // Validate cart is not empty
            if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
                error_log("Keranjang kosong atau tidak ada session cart");
                throw new Exception("Cart is empty");
            }

            $idOrder = uniqid();
            $tanggalTransaksi = date('Y-m-d');
            $struk = bin2hex(random_bytes(10));
            $status = "proses"; // Initial status

            // Debug log untuk insert ke order_tiket
            error_log("Memulai proses checkout dengan Order ID: " . $idOrder);

            // Insert into order_tiket with status
            $queryOrder = "INSERT INTO order_tiket (id_order, tanggal_transaksi, struk, status) 
                      VALUES ('$idOrder', '$tanggalTransaksi', '$struk', '$status')";
            $resultOrder = mysqli_query($conn, $queryOrder);

            if (!$resultOrder) {
                error_log("Query gagal saat insert order_tiket: " . mysqli_error($conn));
                throw new Exception("Error inserting into order_tiket: " . mysqli_error($conn));
            }

            // Log untuk setiap item di keranjang
            foreach ($_SESSION["cart"] as $id_jadwal => $kuantitas) {
                error_log("Memproses item di keranjang - Jadwal ID: $id_jadwal, Kuantitas: $kuantitas");

                // Get ticket details
                $tiket = query("SELECT * FROM jadwal_penerbangan 
                             INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                             INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
                             WHERE id_jadwal = '$id_jadwal'");

                if (empty($tiket)) {
                    error_log("Tiket tidak ditemukan untuk ID: " . $id_jadwal);
                    throw new Exception("Ticket not found for ID: " . $id_jadwal);
                }

                $tiket = $tiket[0];
                $id_user = $data["id_user"];
                $totalHarga = $tiket["harga"] * $kuantitas;
                $sisaKapasitas = $tiket["kap_kursi"] - $kuantitas;

                if ($sisaKapasitas < 0) {
                    error_log("Kapasitas tidak cukup untuk tiket ID: " . $id_jadwal);
                    throw new Exception("Not enough seats available for ticket ID: " . $id_jadwal);
                }

                error_log("Memasukkan order_detail - User: $id_user, Jadwal: $id_jadwal, Order: $idOrder");

                // Insert into order_detail (using id_jadwal as id_penerbangan)
                $queryOrderDetail = "INSERT INTO order_detail 
                               (id_user, id_penerbangan, id_order, jumlah_tiket, total_harga) 
                               VALUES 
                               ('$id_user', '$id_jadwal', '$idOrder', '$kuantitas', '$totalHarga')";

                $resultOrderDetail = mysqli_query($conn, $queryOrderDetail);

                if (!$resultOrderDetail) {
                    error_log("Gagal insert order_detail: " . mysqli_error($conn));
                    throw new Exception("Error inserting into order_detyail: " . mysqli_error($conn));
                }

                // Update seat capacity
                $updateKapasitas = mysqli_query($conn, "UPDATE jadwal_penerbangan 
                                                  SET kap_kursi = '$sisaKapasitas' 
                                                  WHERE id_jadwal = '$id_jadwal'");

                if (!$updateKapasitas) {
                    error_log("Gagal update kapasitas kursi: " . mysqli_error($conn));
                    throw new Exception("Error updating seat capacity: " . mysqli_error($conn));
                }
            }

            // Jika sampai sini berarti sukses
            mysqli_commit($conn);
            error_log("Transaction committed successfully");

            // Clear the cart
            unset($_SESSION["cart"]);

            return true;
        } catch (Exception $e) {
            // Rollback transaction jika ada kesalahan
            mysqli_rollback($conn);
            error_log("Error saat checkout: " . $e->getMessage());
            error_log("SQL Error: " . mysqli_error($conn));
            return false;
        }
    }
}
