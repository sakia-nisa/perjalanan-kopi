@extends('layouts.app')

@section('content')

<div class="max-w-[1400px] mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row
                lg:items-center
                lg:justify-between
                gap-5 mb-10">

        <!-- TITLE -->
        <div>

            <h1 class="text-5xl font-bold text-[#2d140d]">
                Profil Admin
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Kelola informasi akun administrator Perjalanan Kopi.
            </p>

        </div>

        <!-- BACK -->
        <a href="/dashboard"
           class="w-fit bg-white border border-[#eee]
                  hover:bg-[#faf7f5]
                  px-6 py-4 rounded-2xl
                  flex items-center gap-3
                  text-[#2d140d] font-semibold transition">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- LEFT -->
        <div>

            <!-- PROFILE CARD -->
            <div class="bg-white rounded-[36px]
                        border border-[#eee]
                        shadow-sm overflow-hidden">

                <!-- COVER -->
                <div class="h-44 bg-gradient-to-r
                            from-[#2d140d]
                            to-[#6b3e2e]"></div>

                <!-- CONTENT -->
                <div class="px-8 pb-8 relative">

                    <!-- PHOTO -->
                    <div class="w-36 h-36 rounded-full
                                bg-white p-2
                                absolute -top-16 left-8
                                shadow-lg">

                        <div class="w-full h-full rounded-full
                                    bg-[#f5ebe4]
                                    flex items-center justify-center">

                            <i class="fa-solid fa-user
                                      text-6xl text-[#6b3e2e]"></i>

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="pt-24">

                        <h2 class="text-3xl font-bold text-[#2d140d]">

                            {{ auth()->user()->name }}

                        </h2>

                        <p class="text-gray-400 mt-2">

                            {{ auth()->user()->username }}

                        </p>

                        <!-- BADGE -->
                        <div class="mt-6">

                            <span class="bg-[#f5ebe4]
                                         text-[#6b3e2e]
                                         px-5 py-3 rounded-2xl
                                         font-semibold">

                                Administrator

                            </span>

                        </div>

                    </div>

                    <!-- STATS -->
                    <div class="grid grid-cols-2 gap-4 mt-10">

                        <!-- STATUS -->
                        <div class="bg-[#faf7f5]
                                    rounded-3xl p-5">

                            <p class="text-gray-400 text-sm">
                                Status
                            </p>

                            <h3 class="text-xl font-bold
                                       text-green-600 mt-3">

                                Active

                            </h3>

                        </div>

                        <!-- ROLE -->
                        <div class="bg-[#faf7f5]
                                    rounded-3xl p-5">

                            <p class="text-gray-400 text-sm">
                                Role
                            </p>

                            <h3 class="text-xl font-bold
                                       text-[#2d140d] mt-3">

                                Admin

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="xl:col-span-2">

            <!-- FORM CARD -->
            <div class="bg-white rounded-[36px]
                        border border-[#eee]
                        shadow-sm p-8">

                <!-- TOP -->
                <div class="flex items-center gap-4 mb-10">

                    <div class="w-16 h-16 rounded-3xl
                                bg-[#f8f2ee]
                                flex items-center justify-center">

                        <i class="fa-solid fa-user-gear
                                  text-[#6b3e2e] text-2xl"></i>

                    </div>

                    <div>

                        <h2 class="text-3xl font-bold text-[#2d140d]">
                            Pengaturan Akun
                        </h2>

                        <p class="text-gray-400 mt-2">
                            Update informasi akun dan password admin.
                        </p>

                    </div>

                </div>

                <!-- FORM -->
                <form
                    action="/profile"
                    method="POST"
                    class="space-y-8">

                    @csrf
                    @method('PUT')

                    <!-- NAME -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Nama Admin
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ auth()->user()->name }}"
                            required
                            class="w-full bg-[#faf7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4
                                   outline-none">

                    </div>

                    <!-- USERNAME -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ auth()->user()->username }}"
                            required
                            class="w-full bg-[#faf7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4
                                   outline-none">

                    </div>

                    <!-- PASSWORD -->
                    <div class="border-t border-dashed pt-8">

                        <h3 class="text-2xl font-bold text-[#2d140d]">
                            Ganti Password
                        </h3>

                        <p class="text-gray-400 mt-2">
                            Kosongkan jika tidak ingin mengganti password.
                        </p>

                    </div>
                                        <!-- CURRENT PASSWORD -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Password Lama
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            placeholder="Masukkan password lama"
                            class="w-full bg-[#faf7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4
                                   outline-none">

                    </div>

                    <!-- NEW PASSWORD -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- PASSWORD -->
                        <div>

                            <label class="text-sm text-gray-500 mb-3 block">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Masukkan password baru"
                                class="w-full bg-[#faf7f5]
                                       border border-[#eee]
                                       rounded-2xl px-5 py-4
                                       outline-none">

                        </div>

                        <!-- CONFIRM -->
                        <div>

                            <label class="text-sm text-gray-500 mb-3 block">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Konfirmasi password"
                                class="w-full bg-[#faf7f5]
                                       border border-[#eee]
                                       rounded-2xl px-5 py-4
                                       outline-none">

                        </div>

                    </div>

                    <!-- ERROR -->
                    @if ($errors->any())

                        <div class="bg-red-50
                                    border border-red-100
                                    rounded-3xl p-5">

                            <ul class="space-y-2">

                                @foreach ($errors->all() as $error)

                                    <li class="text-red-500">

                                        • {{ $error }}

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <!-- SUCCESS -->
                    @if(session('success'))

                        <div class="bg-green-50
                                    border border-green-100
                                    rounded-3xl p-5">

                            <p class="text-green-600 font-medium">

                                {{ session('success') }}

                            </p>

                        </div>

                    @endif

                    <!-- BUTTON -->
                    <div class="flex flex-wrap items-center gap-4 pt-4">

                        <button
                            type="submit"
                            class="bg-gradient-to-r
                                   from-[#2d140d]
                                   to-[#6b3e2e]
                                   hover:opacity-90
                                   text-white px-8 py-4
                                   rounded-2xl font-semibold
                                   transition">

                            Simpan Perubahan

                        </button>

                        <button
                            type="reset"
                            class="bg-white border border-[#eee]
                                   hover:bg-[#faf7f5]
                                   px-8 py-4 rounded-2xl
                                   font-semibold transition">

                            Reset

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection