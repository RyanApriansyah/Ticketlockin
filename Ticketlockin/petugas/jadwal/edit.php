<?php
session_start();
require 'function.php';

if (!isset($_SESSION["username"])) {
    echo "<script>alert('anda tidak memiliki akses untuk mengakses menu ini !');
    window.location='../../auth/login/index.php'</script>";
}


if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "<script type='text/javascript'>alert('berhasil edit data jadwal penerbangan');
    window.location='index.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('gagal menambahkan data, silahkan coba kembali');
        window.location='edit.php'</script>";
    }
}
$id = $_GET["id"];

$jadwal = query("SELECT * FROM jadwal_penerbangan INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai where id_jadwal = '$id'")[0];


$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai");
?>

<?php require '../../layouts/sidebar_petugas.php';

?>
<div class="p-4 sm:ml-64">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Jadwal Penerbangan</h2>
    <form action="" method="POST">
        <input type="hidden" name="id_jadwal" value="<?= $jadwal["id_jadwal"] ?>">
        <div class="mb-4">
            <label class="block mb-1 text-gray-700 font-medium">Pilih rute</label>
            <select name="id_rute" id="" class="w-full px-4 py-2 border 
                border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="<?= $jadwal["id_rute"] ?>"><?= $jadwal["nama_maskapai"] ?> : <?= $jadwal["rute_asal"] ?> - <?= $jadwal["rute_tujuan"] ?> - <?= $jadwal["tanggal_go"] ?></option>
                <?php foreach ($rute as $r): ?>
                    <option value="<?= $r["id_rute"] ?>"><?= $r["nama_maskapai"] ?> : <?= $r["rute_asal"] ?> - <?= $r["rute_tujuan"] ?> - <?= $r["tanggal_go"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Waktu Berangkat</label>
                <input type="time" name="waktu_go" value="<?= $jadwal["waktu_go"] ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Waktu Tiba</label>
                <input type="time" name="waktu_land" value="<?= $jadwal["waktu_land"] ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Harga</label>
                <input type="number" name="harga" value="<?= $jadwal["harga"] ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Kapasitas Kursi</label>
                <input type="number" name="kap_kursi" value="<?= $jadwal["kap_kursi"] ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" name="edit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                Submit
            </button>
        </div>
    </form>
</div>