<?php

require 'function.php';
if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "<script type='text/javascript'>alert('berhasil tambah data');
        window.location='index.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('gagal menambahkan data, silahkan coba kembali');
        window.location='tambah.php'</script>";
    }
}

?>
<?php require '../../layouts/sidebar_petugas.php' ?>

<div class="p-4 sm:ml-64">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Maskapai</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Foto Maskapai</label>
                <input type="file" name="foto_maskapai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Nama Maskapai</label>
                <input type="text" name="nama_maskapai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" name="tambah"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                Submit
            </button>
        </div>
    </form>
</div>