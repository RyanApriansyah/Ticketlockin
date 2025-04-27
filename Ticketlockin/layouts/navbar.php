<?php
require '../penumpang/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E - Ticketing</title>
    <!-- Sertakan Tailwind CSS melalui CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Navbar Brand -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-2xl font-bold text-gray-800">E - Ticketing</a>
                </div>
                <!-- Desktop Menu (Tengah) -->
                <div class="hidden md:flex md:items-center">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="index.php" class="text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="cart.php" class="text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Cart</a>
                        <a href="pesanan_saya.php" class="text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Pesanan Saya</a>
                        <a href="riwayatorder.php" class="text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">History Transaksi</a>
                    </div>
                </div>
                <!-- Authentication (Kanan) -->
                <div class="hidden md:flex md:items-center">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <span class="text-gray-600 mr-4">Halo, selamat datang <?= $_SESSION['nama_lengkap']; ?></span>
                        <a href="/LSP_RYAN_2025/Ticketlockin/logout.php" class="px-3 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600">Logout</a>
                    <?php else : ?>
                        <a href="/LSP_RYAN_2025/Ticketlockin/auth/login/index.php" class="px-3 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600 mr-2">Login</a>
                    <?php endif; ?>
                </div>
                <!-- Tombol Menu Mobile -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-blue-500 focus:outline-none">
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 5h16v2H4zM4 11h16v2H4zM4 17h16v2H4z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/LSP_RYAN_2025/Ticketlockin/penumpang/index.php" class="block text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="/LSP_RYAN_2025/Ticketlockin/penumpang/cart.php" class="block text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Cart</a>
                <a href="/LSP_RYAN_2025/Ticketlockin/penumpang/pesanan_saya.php" class="block text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Pesanan Saya</a>
                <a href="/LSP_RYAN_2025/Ticketlockin/penumpang/riwayatorder.php" class="block text-gray-600 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">History Transaksi</a>
            </div>
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="px-2">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <span class="block text-gray-600 mb-2">Halo, selamat datang <?= $_SESSION['nama_lengkap']; ?></span>
                        <a href="/LSP_RYAN_2025/Ticketlockin/logout.php" class="block px-3 py-2 bg-blue-500 text-white rounded-md text-base font-medium hover:bg-blue-600">Logout</a>
                    <?php else : ?>
                        <a href="auth/login/" class="block px-3 py-2 bg-blue-500 text-white rounded-md text-base font-medium hover:bg-blue-600 mb-2">Login</a>
                        <a href="auth/register/" class="block px-3 py-2 bg-green-500 text-white rounded-md text-base font-medium hover:bg-green-600">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Script Toggle Mobile Menu -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>