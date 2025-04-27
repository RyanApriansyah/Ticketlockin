<?php
session_start();
require 'function.php';

$id = $_GET["id"];
$mask = query("SELECT * FROM maskapai WHERE id_maskapai = '$id'")[0];


if (isset($_POST["edit"])) {
    if (edit($_POST) > 0) {
        echo "<script type='text/javascript'>alert('data berhasil di edit');
        window.location='index.php'</script>";
    }
    // else {
    //     echo "<script type='text/javascript'>alert('data gagal di edit');
    //     window.location='edit.php'</script>";
    // }
}

?>

<?php require '../../layouts/sidebar.php' ?>

<div class="p-4 sm:ml-64">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Maskapai</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Foto Maskapai</label>
                <input type="hidden" name="id_maskapai" value="<?= $mask["id_maskapai"]; ?>">
                <input type="file" name="foto_maskapai" value="<?= $mask["foto_maskapai"]; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Nama Maskapai</label>
                <input type="text" name="nama_maskapai" required value="<?= $mask["nama_maskapai"]; ?>"
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