<?php
session_start();
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
    <?php require '../layouts/sidebar_petugas.php' ?>
    <div class="p-4 sm:ml-64">
        <p>hi petugas ganteng <?= $_SESSION['nama_lengkap'] ?></p>
    </div>
</body>

</html>