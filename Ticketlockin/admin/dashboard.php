<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script type='text/javascript'> alert('anda tidak mempunyai akses untuk masuk ke halaman ini !');
    window.location='../auth/login/index.php'; </script>
   ";
}

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
    <?php require '../layouts/sidebar.php' ?>
    <div class="p-4 sm:ml-64">
        <p>hi admin <?= $_SESSION['nama_lengkap'] ?></p>
    </div>
</body>

</html>