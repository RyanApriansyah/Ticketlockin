<?php
session_start();
require 'function.php';
if (!isset($_SESSION['username'])) {
    echo "<script>alert('anda tidak memiliki akses untuk mengakses menu ini !');
    window.location='../../auth/login/index.php'</script>";
}

$user = query("SELECT * FROM users");
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
    <?php require '../../layouts/sidebar.php' ?>
    <div class="p-4 sm:ml-64">
        <p>hi admin <?= $_SESSION['nama_lengkap'] ?> ini halaman data pengguna/user</p>
        <div class="flex justify-end">

            <a href="tambah.php" class="font-semibold text-white bg-green-500 rounded-md px-5 py-2 my-5">+ Tambah </a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full  ">
                <tr class="bg-[#225270] text-white">
                    <th class="p-2 text-center">No</th>
                    <th class="p-2 text-center">Nama Lengkap</th>
                    <th class="p-2 text-center">Username</th>
                    <th class="p-2 text-center">Email</th>
                    <th class="p-2 text-center">Role</th>
                    <th class="p-2 text-center">Action</th>
                </tr>
                <?php $no = 1; ?>
                <?php foreach ($user as $u) : ?>
                    <tr class="bg-gray-300 ">
                        <td class="p-3 text-center"><?= $no ?></td>
                        <td class="p-3 text-center"><?= $u["nama_lengkap"] ?></td>
                        <td class="p-3 text-center"><?= $u["username"] ?></td>
                        <td class="p-3 text-center"><?= $u["email"] ?></td>
                        <td class="p-3 text-center"><?= $u["roles"] ?></td>
                        <td class="p-3 text-center ">
                            <div class="flex gap-4 justify-center">
                                <a href="edit.php?id=<?= $u["id_user"]; ?>" class="font-semibold text-white bg-blue-400 rounded-md px-5 py-2">Edit</a>
                                <a href="hapus.php?id=<?= $u["id_user"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ini?')" class="font-semibold text-white bg-red-400 rounded-md px-5 py-2">Hapus</a>
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