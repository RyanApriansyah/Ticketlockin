<?php
session_start();
require 'function.php';
if (!isset($_SESSION["username"])) {
    echo "<script type='text/javascript'> alert('anda tidak mempunyai akses untuk masuk ke halaman ini !');
    window.location='../../auth/login/index.php'; </script>
   ";
}

$id = $_GET['id'];
$user = query("SELECT * FROM users where id_user = '$id'")[0];

if (isset($_POST["edit"])) {
    if (edit($_POST) > 0) {
        echo "
        <script type='text/javascript'>
            alert('Yay! data pengguna berhasil diedit!')
            window.location = 'index.php'
        </script>
    ";
    } else {
        echo "
        <script type='text/javascript'>
            alert('Yhaa .. data pengguna gagal diedit :(')
            window.location = 'index.php'
        </script>
    ";
    }
}


?>

<?php require '../../layouts/sidebar.php' ?>
<div class="p-4 sm:ml-64">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Pengguna</h2>
    <form action="" method="POST">
        <input type="hidden" value="<?= $user["id_user"]; ?>" name="id_user">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required value="<?= $user["nama_lengkap"]; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Username</label>
                <input type="text" name="username" required value="<?= $user["username"]; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Email</label>
                <input type="email" name="email" required value="<?= $user["email"]; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Role</label>
                <select name="roles" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled>Pilih Role</option>
                    <option value="penumpang" <?= $user["roles"] == "penumpang" ? 'selected' : '' ?>>Penumpang</option>
                    <option value="petugas" <?= $user["roles"] == "petugas" ? 'selected' : '' ?>>Petugas</option>
                    <option value="admin" <?= $user["roles"] == "admin" ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1 text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required value="<?= $user["password"]; ?>"
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