@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-10">

        <h1 class="text-5xl font-bold text-[#2d140d]">
            Tambah Menu Baru
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Tambahkan menu baru untuk coffee shop kamu.
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[36px]
                border border-[#eee]
                shadow-sm overflow-hidden">

        <form
            action="/products"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-2">

                <!-- LEFT -->
                <div class="p-10 border-r border-[#f2f2f2]">

                    <!-- IMAGE PREVIEW -->
                    <div class="mb-8">

                        <label class="block text-lg font-semibold
                                      text-[#2d140d] mb-4">

                            Upload Gambar

                        </label>

                        <label
                            for="imageInput"
                            class="cursor-pointer block">

                            <div
                                class="w-full h-[420px]
                                       rounded-[32px]
                                       border-2 border-dashed border-[#d8c7bb]
                                       bg-[#faf7f5]
                                       overflow-hidden
                                       flex items-center justify-center">

                                <img
                                    id="previewImage"
                                    src="https://placehold.co/600x600/f5ebe4/6b3e2e?text=Upload+Image"
                                    class="w-full h-full object-cover">

                            </div>

                        </label>

                        <input
                            type="file"
                            name="image"
                            id="imageInput"
                            class="hidden"
                            accept="image/*">

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="p-10">

                    <!-- MENU NAME -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-500 mb-3">
                            Nama Menu
                        </label>

                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="Contoh: Caramel Latte"
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none
                                   focus:ring-2 focus:ring-[#6b3e2e]/20">

                    </div>

                    <!-- CATEGORY -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-500 mb-3">
                            Kategori
                        </label>

                        <select
                            name="category"
                            required
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                            <option value="">Pilih Kategori</option>

                            <option value="kopi">
                                Kopi
                            </option>

                            <option value="non_kopi">
                                Non Kopi
                            </option>

                            <option value="snack">
                                Snack
                            </option>

                        </select>

                    </div>

                    <!-- PRICE -->
                    <div class="grid grid-cols-2 gap-5 mb-6">

                        <!-- SELLING -->
                        <div>

                            <label class="block text-sm text-gray-500 mb-3">
                                Harga Jual
                            </label>

                            <input
                                type="number"
                                name="selling_price"
                                required
                                placeholder="10000"
                                class="w-full bg-[#f9f7f5]
                                       border border-[#eee]
                                       rounded-2xl px-5 py-4 outline-none">

                        </div>

                        <!-- HPP -->
                        <div>

                            <label class="block text-sm text-gray-500 mb-3">
                                HPP
                            </label>

                            <input
                                type="number"
                                name="hpp"
                                required
                                placeholder="7000"
                                class="w-full bg-[#f9f7f5]
                                       border border-[#eee]
                                       rounded-2xl px-5 py-4 outline-none">

                        </div>

                    </div>

                    <!-- STOCK -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-500 mb-3">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stock"
                            required
                            placeholder="50"
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                    </div>

                    <!-- STATUS -->
                    <div class="mb-10">

                        <label class="block text-sm text-gray-500 mb-3">
                            Status
                        </label>

                        <select
                            name="status"
                            required
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                            <option value="available">
                                Available
                            </option>

                            <option value="unavailable">
                                Unavailable
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex items-center gap-4">

                        <!-- SAVE -->
                        <button
                            type="submit"
                            class="flex-1 bg-gradient-to-r
                                   from-[#2d140d]
                                   to-[#6b3e2e]
                                   hover:opacity-90
                                   text-white py-5 rounded-2xl
                                   text-lg font-semibold transition">

                            Simpan Menu

                        </button>

                        <!-- BACK -->
                        <a href="/products"
                           class="px-8 py-5 rounded-2xl
                                  border border-[#ddd]
                                  hover:bg-gray-50
                                  font-semibold transition">

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- IMAGE PREVIEW -->
<script>

    const imageInput =
        document.getElementById('imageInput');

    const previewImage =
        document.getElementById('previewImage');

    imageInput.addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (file) {

            previewImage.src =
                URL.createObjectURL(file);

        }

    });

</script>

@endsection