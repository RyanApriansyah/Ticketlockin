<?php
require 'logic.php';

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo "<script type='text/javascript'>alert('register anda berhasil');
        window.location = '../login/index.php';
        </script>";
    } else {
        echo "<script type='text/javascript'>alert('register anda gagal');
        window.location = 'index.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register
    </title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>



</head>

<body class="bg-[#F8F7F3]">
    <div class="flex justify-center items-center h-screen font-Montserrat">
        <div class="bg-white rounded-lg w-fit h-fit p-8">
            <p class="text-2xl font-bold text-center mb-20 ">Ticket Lock<span class="text-blue-400">In</span></p>

            <form action="" method="POST">
                <div class="flex gap-5 mb-4">
                    <div class="">
                        <label for="" class="text-lg font-semibold mb-2">Nama Lengkap</label><br>
                        <input type="text" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" class="w-80 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                    </div>
                    <div class="">
                        <label for="" class="text-lg font-semibold mb-2">Username</label><br>
                        <input type="text" name="username" placeholder="Masukkan Nama Username" class="w-80 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                    </div>
                </div>
                <div class="flex gap-5">
                    <div class="">

                        <label for="" class="text-lg font-semibold mb-2">Email</label><br>
                        <input type="text" name="email" placeholder="Masukkan Nama Email" class="w-80 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                        <input type="hidden" name="roles" value="penumpang" class="w-80 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                    </div>
                    <div class="">

                        <label for="" class="text-lg font-semibold mb-2">Password</label><br>
                        <input type="password" name="password" placeholder="Masukkan Nama Password" class="w-80 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                    </div>
                </div>
                <button type="submit" name="register" class="w-full bg-blue-400 py-2 rounded-lg justify-center font-semibold text-white mt-10 hover:bg-blue-500 transtion-all duration-120 flex">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>