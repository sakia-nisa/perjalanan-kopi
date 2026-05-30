<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjalanan Kopi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-[#f6f1eb] min-h-screen">
<!-- NAVBAR -->
<nav class="bg-gradient-to-r from-[#2d140d] to-[#6b3e2e] shadow-lg">
    <div class="max-w-[1800px] mx-auto px-4 lg:px-5">
        <div class="flex items-center justify-between h-20">
            <!-- LOGO -->
            <div>
                <h1 class="font-playfair text-white text-3xl font-bold leading-none">
                    PERJALANAN KOPI
                </h1>
                <p class="text-[#f5d7bf] tracking-[2px] text-sm mt-2 uppercase">
                    Brewing Joy • Since 2024
                </p>
            </div>
            <!-- MENU -->
            <div class="hidden xl:flex items-center gap-3">
                <a href="/dashboard" class="text-white px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium hover:bg-white/10 transition">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
                <a href="/products" class="text-white px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium hover:bg-white/10 transition">
                    <i class="fa-solid fa-mug-hot"></i>
                    Menu
                </a>
                <a href="/orders" class="text-white px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium hover:bg-white/10 transition">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Orders
                </a>
                <a href="/reports" class="text-white px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium hover:bg-white/10 transition">
                    <i class="fa-solid fa-chart-column"></i>
                    Reports
                </a>
                <a href="/profile" class="text-white px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium hover:bg-white/10 transition">
                    <i class="fa-solid fa-user"></i>
                    Profile
                </a>
                <!-- LOGOUT -->
                <form action="/logout" method="POST">
                    @csrf
                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-2xl font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
            <!-- MOBILE BUTTON -->
            <button id="menuButton"
                    class="xl:hidden bg-[#c08a67] w-12 h-12 rounded-2xl flex flex-col items-center justify-center gap-1.5">
                <span class="w-6 h-0.5 bg-white rounded-full"></span>
                <span class="w-6 h-0.5 bg-white rounded-full"></span>
                <span class="w-6 h-0.5 bg-white rounded-full"></span>
            </button>
        </div>
    </div>
</nav>
<!-- MOBILE MENU -->
<div id="mobileMenu" class="hidden xl:hidden bg-[#2d140d] border-t border-white/10">
    <div class="flex flex-col p-5 gap-3">
        <a href="/dashboard" class="text-white px-4 py-3 rounded-xl hover:bg-white/10 transition">
            Dashboard
        </a>
        <a href="/products" class="text-white px-4 py-3 rounded-xl hover:bg-white/10 transition">
            Menu
        </a>
        <a href="/orders" class="text-white px-4 py-3 rounded-xl hover:bg-white/10 transition">
            Orders
        </a>
        <a href="/reports" class="text-white px-4 py-3 rounded-xl hover:bg-white/10 transition">
            Reports
        </a>
        <a href="/profile" class="text-white px-4 py-3 rounded-xl hover:bg-white/10 transition">
            Profile
        </a>
        <form action="/logout" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl transition">Logout</button>
        </form>
    </div>
</div>

<!-- CONTENT -->
<div class="max-w-[1800px] mx-auto px-5 lg:px-10 py-10">
    @if(session('success'))
        <div class="bg-green-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg">
            {{ session('error') }}
        </div>
    @endif
    @yield('content')
</div>
<script>
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>