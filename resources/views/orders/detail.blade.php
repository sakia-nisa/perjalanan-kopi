@extends('layouts.app')

@section('content')

<div class="max-w-[1700px] mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center gap-5 mb-10">

        <!-- BACK -->
        <a href="/orders"
           class="w-fit bg-white border border-[#eee]
                  hover:bg-[#faf7f5]
                  px-6 py-4 rounded-2xl
                  flex items-center gap-3
                  text-[#2d140d] font-semibold transition">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>

        <!-- TITLE -->
        <div>

            <h1 class="text-5xl font-bold text-[#2d140d]">
                Detail Pesanan
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Informasi lengkap pesanan dari pelanggan.
            </p>

        </div>

    </div>

    <!-- ORDER INFO -->
    <div class="bg-white rounded-[32px]
                border border-[#eee]
                shadow-sm p-6 mb-8">

        <!-- TITLE -->
        <div class="flex items-center gap-3 mb-8">

            <div class="w-12 h-12 rounded-2xl
                        bg-[#f8f2ee]
                        flex items-center justify-center">

                <i class="fa-regular fa-clipboard text-[#6b3e2e] text-xl"></i>

            </div>

            <h2 class="text-3xl font-bold text-[#2d140d]">
                Informasi Pesanan
            </h2>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- LEFT -->
            <div class="space-y-8">

                <!-- ORDER -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-solid fa-hashtag text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400">
                            No Order
                        </p>

                        <h3 class="text-2xl font-bold text-[#2d140d]">
                            {{ $order->id }}
                        </h3>

                    </div>

                </div>

                <!-- CUSTOMER -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-regular fa-user text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400">
                            Customer
                        </p>

                        <h3 class="text-2xl font-bold text-[#2d140d]">
                            {{ $order->customer_name }}
                        </h3>

                    </div>

                </div>

                <!-- TYPE -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-solid fa-bag-shopping text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400">
                            Tipe Order
                        </p>

                        <h3 class="text-2xl font-bold text-[#2d140d]">
                            {{ $order->order_type }}
                        </h3>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-8">

                <!-- NOTE -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-regular fa-note-sticky text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400">
                            Catatan
                        </p>

                        <h3 class="text-2xl font-bold text-[#2d140d]">
                            {{ $order->note ?? '-' }}
                        </h3>

                    </div>

                </div>

                <!-- STATUS -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-regular fa-circle-check text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400 mb-2">
                            Status
                        </p>

                        <span class="
                            px-5 py-3 rounded-2xl
                            text-sm font-semibold

                            @if($order->status == 'completed')
                                bg-[#e7f6e8] text-[#3f9b4f]
                            @elseif($order->status == 'pending')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-blue-100 text-blue-700
                            @endif
                        ">

                            {{ $order->status }}

                        </span>

                    </div>

                </div>

                <!-- TIME -->
                <div class="flex items-start gap-5">

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#faf7f5]
                                flex items-center justify-center">

                        <i class="fa-regular fa-clock text-[#6b3e2e] text-xl"></i>

                    </div>

                    <div>

                        <p class="text-gray-400">
                            Waktu
                        </p>

                        <h3 class="text-2xl font-bold text-[#2d140d]">

                            {{ \Carbon\Carbon::parse($order->order_time)->format('d-m-Y H:i:s') }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2">

            <div class="bg-white rounded-[32px]
                        border border-[#eee]
                        shadow-sm p-6">

                <!-- TITLE -->
                <div class="flex items-center gap-3 mb-8">

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#f8f2ee]
                                flex items-center justify-center">

                        <i class="fa-solid fa-bag-shopping text-[#6b3e2e] text-xl"></i>

                    </div>

                    <h2 class="text-3xl font-bold text-[#2d140d]">
                        Item Pesanan
                    </h2>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-[#faf7f5]">

                                <th class="text-left px-6 py-5 rounded-l-2xl">
                                    No
                                </th>

                                <th class="text-left px-6 py-5">
                                    Menu
                                </th>

                                <th class="text-left px-6 py-5">
                                    Qty
                                </th>

                                <th class="text-left px-6 py-5">
                                    Harga Jual
                                </th>

                                <th class="text-left px-6 py-5">
                                    HPP
                                </th>

                                <th class="text-left px-6 py-5">
                                    Subtotal
                                </th>

                                <th class="text-left px-6 py-5 rounded-r-2xl">
                                    Keuntungan Item
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($order->items as $item)

                            <tr class="border-b border-[#f2f2f2]">

                                <td class="px-6 py-6">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-6">

                                    <div class="flex items-center gap-4">

                                        <img
                                            src="{{ asset('storage/' . ($item->product->image ?? 'default.png')) }}"
                                            class="w-16 h-16 rounded-2xl object-cover">

                                        <h3 class="font-semibold text-lg text-[#2d140d]">
                                            {{ $item->product->name ?? '-' }}
                                        </h3>

                                    </div>

                                </td>

                                <td class="px-6 py-6">
                                    {{ $item->quantity }}
                                </td>

                                <td class="px-6 py-6">
                                    Rp {{ number_format($item->selling_price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-6">
                                    Rp {{ number_format($item->hpp, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-6">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-6 text-green-600 font-semibold">

                                    Rp {{ number_format(($item->selling_price - $item->hpp) * $item->quantity, 0, ',', '.') }}

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!-- FOOT -->
                <div class="border-t border-dashed mt-6 pt-6">


                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div>

            <div class="bg-white rounded-[32px]
                        border border-[#eee]
                        shadow-sm p-6">

                <!-- TITLE -->
                <div class="flex items-center gap-3 mb-8">

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#f8f2ee]
                                flex items-center justify-center">

                        <i class="fa-solid fa-wallet text-[#6b3e2e] text-xl"></i>

                    </div>

                    <h2 class="text-3xl font-bold text-[#2d140d]">
                        Ringkasan Pembayaran
                    </h2>

                </div>

                <!-- SUMMARY -->
                <div class="space-y-6">

                    <!-- DISCOUNT -->
                    <div class="flex items-center justify-between">

                        <p class="text-xl text-[#2d140d]">
                            Diskon
                        </p>

                        <h3 class="text-2xl font-semibold">
                            Rp {{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="border-t border-dashed"></div>

                    <!-- TOTAL -->
                    <div class="flex items-center justify-between">

                        <p class="text-2xl font-bold text-[#2d140d]">
                            Total Akhir
                        </p>

                        <h3 class="text-4xl font-bold text-[#2d140d]">

                            Rp {{ number_format($order->total_price, 0, ',', '.') }}

                        </h3>

                    </div>

                    @if($order->payment)

                        <div class="border-t border-dashed"></div>

                        <!-- METHOD -->
                        <div class="flex items-center justify-between">

                            <p class="text-xl text-[#2d140d]">
                                Metode Bayar
                            </p>

                            <h3 class="text-2xl font-semibold">
                                {{ $order->payment->payment_method }}
                            </h3>

                        </div>

                        <!-- PAID -->
                        <div class="flex items-center justify-between">

                            <p class="text-xl text-[#2d140d]">
                                Jumlah Bayar
                            </p>

                            <h3 class="text-3xl font-bold text-[#2d140d]">

                                Rp {{ number_format($order->payment->amount_paid, 0, ',', '.') }}

                            </h3>

                        </div>

                        <!-- CHANGE -->
                        <div class="flex items-center justify-between">

                            <p class="text-xl text-[#2d140d]">
                                Kembalian
                            </p>

                            <h3 class="text-3xl font-bold text-green-600">

                                Rp {{ number_format($order->payment->change_amount, 0, ',', '.') }}

                            </h3>

                        </div>

                    @endif

                </div>

                <!-- BUTTON -->
                <a href="/orders"
                   class="mt-10 w-full bg-[#faf7f5]
                          hover:bg-[#f5ebe4]
                          py-5 rounded-2xl
                          flex items-center justify-center gap-3
                          text-[#2d140d] text-xl
                          font-semibold transition">

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection