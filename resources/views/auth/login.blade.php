<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjalanan Kopi</title>
    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Icon --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <style>
        body{
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }
        .coffee-bg{
            background:
                linear-gradient(rgba(10,8,7,.72), rgba(10,8,7,.78)),
                url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1400&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .glass{
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
        .floating{
            animation: floating 4s ease-in-out infinite;
        }
        @keyframes floating{
            0%{
                transform: translateY(0px);
            }
            50%{
                transform: translateY(-8px);
            }
            100%{
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="coffee-bg min-h-screen flex items-center justify-center p-6">
    <!-- CARD -->
    <div class="w-full max-w-[430px]">
        <div class="glass bg-white/90 rounded-[28px] shadow-2xl px-8 py-9 border border-white/30">
            <!-- LOGO -->
            <div class="flex justify-center mb-5">
                <div class="floating w-[62px] h-[62px] rounded-2xl bg-[#1b0604] flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-mug-hot text-white text-xl"></i>
                </div>
            </div>
            <!-- TITLE -->
            <div class="text-center mb-8">
                <h1 class="text-[42px] leading-[45px] font-bold text-[#160806]">
                    Perjalanan Kopi
                </h1>
            </div>
            <!-- HEADING -->
            <div class="text-center mb-7">
                <h2 class="text-[36px] font-bold text-[#2d201d] leading-tight">Selamat Datang<br>Kembali</h2>
                <p class="text-[#7a6f6b] text-[15px] mt-2">Silakan masuk ke sistem kasir Anda</p>
            </div>
            {{-- ERROR --}}
            @if(session('error'))
                <div class="mb-5 bg-red-100 border border-red-200 text-red-600 rounded-2xl px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-5 bg-red-100 border border-red-200 text-red-600 rounded-2xl px-4 py-3 text-sm">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <!-- FORM -->
            <form action="/login" method="POST" class="space-y-5">
                @csrf
                <!-- USERNAME -->
                <div>
                    <label class="block text-[13px] font-semibold text-[#5c514d] mb-2">
                        ID Barista
                    </label>
                    <div class="relative">
                        <i class="fa-regular fa-id-badge absolute left-4 top-1/2 -translate-y-1/2 text-[#8c817c]"></i>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan ID Anda" required autofocus class="w-full h-[54px] rounded-xl bg-[#ece8e5] border border-[#d8d0cc] pl-12 pr-4 outline-none focus:ring-4 focus:ring-[#4b1e16]/20 focus:border-[#4b1e16] transition">
                    </div>
                </div>
                <!-- PASSWORD -->
                <div>
                    <label class="block text-[13px] font-semibold text-[#5c514d] mb-2">PIN</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#8c817c]"></i>
                        <input type="password" name="password" id="password" placeholder="••••" required
                            class="w-full h-[54px] rounded-xl bg-[#ece8e5] border border-[#d8d0cc] pl-12 pr-14 outline-none focus:ring-4 focus:ring-[#4b1e16]/20 focus:border-[#4b1e16] transition"
                        >
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6f6661] hover:text-[#2b0c08]"
                        >
                            <i id="eyeIcon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <!-- BUTTON -->
                <button type="submit" class="w-full h-[56px] rounded-xl bg-[#1b0604] hover:bg-[#2a0b08] transition duration-300 text-white font-semibold text-[20px] shadow-xl flex items-center justify-center gap-2 mt-2">
                    Masuk
                    <i class="fa-solid fa-arrow-right-to-bracket text-[16px]"></i>
                </button>
            </form>
            <!-- FORGOT -->
            <div class="text-center mt-8">
                <a href="#" class="text-[13px] text-[#8b817d] hover:text-[#2b0c08] transition">Lupa PIN atau ID?</a>
            </div>
            <!-- FOOTER -->
            <div class="flex items-center gap-3 my-7">
                <div class="h-[1px] bg-[#d7cfca] flex-1"></div>
                <p class="text-[13px] text-[#5f5651]">Downtown Branch</p>
                <div class="h-[1px] bg-[#d7cfca] flex-1"></div>
            </div>
            <!-- STATUS -->
            <div class="flex items-center justify-center gap-3 text-[11px] text-[#9b918c]">
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Sistem Online
                </div>
                <span>•</span>
                <div>v2.4.0</div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if(passwordInput.type === 'password'){
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }else{
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>