<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#F8F7F3]">
    <div class="flex justify-center items-center h-screen font-Montserrat">
        <div class="bg-white rounded-lg w-fit h-fit p-8">
            <p class="text-2xl font-bold text-center mb-12 ">Ticket Lock<span class="text-blue-400">In</span></p>

            <form action="logic.php" method="POST">

                <div class="">

                    <label for="" class="text-lg font-semibold mb-2">Email</label><br>
                    <input type="text" name="email" id="email" required placeholder="Masukkan Nama Email" class="w-96 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                </div>
                <div class="">

                    <label for="" class="text-lg font-semibold mb-2">Password</label><br>
                    <input type="password" name="password" required id="password" placeholder="Masukkan Nama Password" class="w-96 border-2 px-2 py-2 mt-2 rounded-md outline-blue-400 border-gray-200"><br><br>
                </div>
                <a href="../register/index.php" class="text-xs justify-center w-full flex mt-5 text-blue-300">Belum punya akun? Register disini !</a>
                <button type="submit" name="login" class="w-full bg-blue-400 py-2 rounded-lg justify-center font-semibold text-white mt-5 hover:bg-blue-500 transtion-all duration-120 flex">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>