
@extends('layouts.app')

@section('content')

<div class="max-w-[1700px] mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6 mb-10">

        <!-- TITLE -->
        <div>

            <h1 class="text-5xl font-bold text-[#2d140d]">
                Laporan Penjualan
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Pantau performa bisnis dan transaksi penjualan cafe.
            </p>

        </div>

        <!-- ACTION -->
        <div class="flex flex-wrap gap-3">

            <a href="/reports/export/csv?{{ request()->getQueryString() }}"
               class="bg-green-600 hover:bg-green-700
                      text-white px-5 py-4 rounded-2xl
                      font-semibold transition">

                Download CSV

            </a>

            <a href="/reports/export/excel?{{ request()->getQueryString() }}"
               class="bg-emerald-600 hover:bg-emerald-700
                      text-white px-5 py-4 rounded-2xl
                      font-semibold transition">

                Download Excel

            </a>

            <a href="/reports/export/pdf?{{ request()->getQueryString() }}"
               class="bg-red-500 hover:bg-red-600
                      text-white px-5 py-4 rounded-2xl
                      font-semibold transition">

                Download PDF

            </a>

            <a href="/reports/print?{{ request()->getQueryString() }}"
               class="bg-[#2d140d] hover:opacity-90
                      text-white px-5 py-4 rounded-2xl
                      font-semibold transition">

                Print View

            </a>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-[32px]
                border border-[#eee]
                shadow-sm p-7 mb-10">

        <form
            method="GET"
            action="/reports"
            class="grid grid-cols-1 lg:grid-cols-12 gap-4">

            <!-- START -->
            <div class="lg:col-span-3">

                <label class="text-sm text-gray-500 mb-3 block">
                    Tanggal Awal
                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ $start }}"
                    class="w-full bg-[#faf7f5]
                           border border-[#eee]
                           rounded-2xl px-5 py-4 outline-none">

            </div>

            <!-- END -->
            <div class="lg:col-span-3">

                <label class="text-sm text-gray-500 mb-3 block">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ $end }}"
                    class="w-full bg-[#faf7f5]
                           border border-[#eee]
                           rounded-2xl px-5 py-4 outline-none">

            </div>

            <!-- BUTTON -->
            <div class="lg:col-span-6 flex flex-wrap items-end gap-3">

                <button
                    type="submit"
                    class="bg-gradient-to-r
                           from-[#2d140d]
                           to-[#6b3e2e]
                           hover:opacity-90
                           text-white px-6 py-4
                           rounded-2xl font-semibold transition">

                    Filter

                </button>

                <a href="/reports?period=today"
                   class="bg-white border border-[#eee]
                          hover:bg-[#faf7f5]
                          px-5 py-4 rounded-2xl
                          font-semibold transition">

                    Hari Ini

                </a>

                <a href="/reports?period=week"
                   class="bg-white border border-[#eee]
                          hover:bg-[#faf7f5]
                          px-5 py-4 rounded-2xl
                          font-semibold transition">

                    Minggu Ini

                </a>

                <a href="/reports?period=month"
                   class="bg-white border border-[#eee]
                          hover:bg-[#faf7f5]
                          px-5 py-4 rounded-2xl
                          font-semibold transition">

                    Bulan Ini

                </a>

                <a href="/reports"
                   class="bg-red-50 text-red-500
                          hover:bg-red-100
                          px-5 py-4 rounded-2xl
                          font-semibold transition">

                    Reset

                </a>

            </div>

        </form>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- ORDER -->
        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Total Order
                    </p>

                    <h3 class="text-4xl font-bold
                               text-[#2d140d] mt-3">

                        {{ $totalOrders }}

                    </h3>

                </div>

                <div class="w-16 h-16 rounded-3xl
                            bg-[#f8f2ee]
                            flex items-center justify-center">

                    <i class="fa-solid fa-cart-shopping
                              text-[#6b3e2e] text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- ITEM -->
        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Total Item Terjual
                    </p>

                    <h3 class="text-4xl font-bold
                               text-[#2d140d] mt-3">

                        {{ $totalItemsSold }}

                    </h3>

                </div>

                <div class="w-16 h-16 rounded-3xl
                            bg-[#f8f2ee]
                            flex items-center justify-center">

                    <i class="fa-solid fa-mug-hot
                              text-[#6b3e2e] text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- INCOME -->
        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Pendapatan
                    </p>

                    <h3 class="text-4xl font-bold
                               text-[#2d140d] mt-3">

                        Rp {{ number_format($totalIncome, 0, ',', '.') }}

                    </h3>

                </div>

                <div class="w-16 h-16 rounded-3xl
                            bg-[#f8f2ee]
                            flex items-center justify-center">

                    <i class="fa-solid fa-wallet
                              text-[#6b3e2e] text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- PROFIT -->
        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Keuntungan
                    </p>

                    <h3 class="text-4xl font-bold
                               text-green-600 mt-3">

                        Rp {{ number_format($totalProfit, 0, ',', '.') }}

                    </h3>

                </div>

                <div class="w-16 h-16 rounded-3xl
                            bg-[#edf7e7]
                            flex items-center justify-center">

                    <i class="fa-solid fa-chart-line
                              text-green-600 text-2xl"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- SECOND STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <p class="text-gray-400">
                Total HPP
            </p>

            <h3 class="text-4xl font-bold text-[#2d140d] mt-4">
                Rp {{ number_format($totalHpp, 0, ',', '.') }}
            </h3>

        </div>

        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <p class="text-gray-400">
                Total Diskon
            </p>

            <h3 class="text-4xl font-bold text-[#2d140d] mt-4">
                Rp {{ number_format($totalDiscount, 0, ',', '.') }}
            </h3>

        </div>

        <div class="bg-white rounded-[32px]
                    border border-[#eee]
                    shadow-sm p-7">

            <p class="text-gray-400">
                Rata-rata Transaksi
            </p>

            <h3 class="text-4xl font-bold text-[#2d140d] mt-4">
                Rp {{ number_format($averageTransaction, 0, ',', '.') }}
            </h3>

        </div>

    </div>
        <!-- TABLE -->
    <div class="bg-white rounded-[32px]
                border border-[#eee]
                shadow-sm p-7">

        <!-- TOP -->
        <div class="flex flex-col xl:flex-row
                    xl:items-center
                    xl:justify-between
                    gap-5 mb-8">

            <div>

                <h2 class="text-3xl font-bold text-[#2d140d]">
                    Riwayat Transaksi
                </h2>

                <p class="text-gray-400 mt-2">
                    Semua data transaksi penjualan cafe.
                </p>

            </div>

            <!-- SEARCH -->
            <div class="relative w-full xl:max-w-md">

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari transaksi..."
                    class="w-full bg-[#faf7f5]
                           border border-[#eee]
                           rounded-2xl px-5 py-4 pl-14 outline-none">

                <i class="fa-solid fa-magnifying-glass
                          absolute left-5 top-1/2
                          -translate-y-1/2 text-gray-400"></i>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1200px]">

                <thead>

                    <tr class="bg-[#faf7f5]">

                        <th class="text-left px-6 py-5 rounded-l-2xl">
                            No
                        </th>

                        <th class="text-left px-6 py-5">
                            Customer
                        </th>

                        <th class="text-left px-6 py-5">
                            Tipe
                        </th>

                        <th class="text-left px-6 py-5">
                            Total
                        </th>

                        <th class="text-left px-6 py-5">
                            HPP
                        </th>

                        <th class="text-left px-6 py-5">
                            Profit
                        </th>

                        <th class="text-left px-6 py-5">
                            Status
                        </th>

                        <th class="text-left px-6 py-5">
                            Waktu
                        </th>

                        <th class="text-center px-6 py-5 rounded-r-2xl">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody id="reportTable">

                    @forelse($orders as $order)

                    @php

                        $profit =
                            $order->items->sum(function($item){

                                return
                                    ($item->selling_price - $item->hpp)
                                    * $item->quantity;

                            });

                        $hpp =
                            $order->items->sum(function($item){

                                return
                                    $item->hpp
                                    * $item->quantity;

                            });

                    @endphp

                    <tr class="border-b border-[#f3f3f3]
                               hover:bg-[#faf7f5]
                               transition report-row">

                        <!-- ID -->
                        <td class="px-6 py-6 font-semibold">

                            {{ $loop->iteration }}

                        </td>

                        <!-- CUSTOMER -->
                        <td class="px-6 py-6">

                            <div>

                                <h3 class="font-semibold text-[#2d140d]">
                                    {{ $order->customer_name }}
                                </h3>

                                <p class="text-sm text-gray-400 mt-1">

                                    {{ $order->payment->payment_method ?? '-' }}

                                </p>

                            </div>

                        </td>

                        <!-- TYPE -->
                        <td class="px-6 py-6">

                            <span class="capitalize">

                                {{ str_replace('_', ' ', $order->order_type) }}

                            </span>

                        </td>

                        <!-- TOTAL -->
                        <td class="px-6 py-6 font-semibold text-[#2d140d]">

                            Rp {{ number_format($order->total_price,0,',','.') }}

                        </td>

                        <!-- HPP -->
                        <td class="px-6 py-6">

                            Rp {{ number_format($hpp,0,',','.') }}

                        </td>

                        <!-- PROFIT -->
                        <td class="px-6 py-6 font-semibold text-green-600">

                            Rp {{ number_format($profit,0,',','.') }}

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-6">

                            @if($order->status == 'completed')

                                <span class="bg-[#edf7e7]
                                             text-green-600
                                             px-4 py-2 rounded-xl
                                             text-sm font-semibold">

                                    Completed

                                </span>

                            @elseif($order->status == 'pending')

                                <span class="bg-[#fff4e5]
                                             text-yellow-600
                                             px-4 py-2 rounded-xl
                                             text-sm font-semibold">

                                    Pending

                                </span>

                            @else

                                <span class="bg-[#f5ebe4]
                                             text-[#6b3e2e]
                                             px-4 py-2 rounded-xl
                                             text-sm font-semibold">

                                    {{ ucfirst($order->status) }}

                                </span>

                            @endif

                        </td>

                        <!-- TIME -->
                        <td class="px-6 py-6 text-gray-500">

                            {{ \Carbon\Carbon::parse($order->order_time)->format('d M Y H:i') }}

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-6">

                            <div class="flex items-center justify-center gap-3">

                                <a href="/orders/{{ $order->id }}/detail"
                                   class="bg-[#f5ebe4]
                                          hover:bg-[#ead7cc]
                                          text-[#6b3e2e]
                                          px-4 py-3 rounded-xl
                                          text-sm font-semibold transition">
                                    Detail

                                </a>

                                <a href="/orders/{{ $order->id }}/receipt"
                                   target="_blank"
                                   class="bg-[#2d140d]
                                          hover:opacity-90
                                          text-white
                                          px-4 py-3 rounded-xl
                                          text-sm font-semibold transition">

                                    Struk

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9">

                            <div class="text-center py-24">

                                <div class="w-24 h-24 rounded-full
                                            bg-[#f8f2ee]
                                            flex items-center justify-center
                                            mx-auto mb-5">

                                    <i class="fa-solid fa-chart-column
                                              text-4xl text-[#6b3e2e]"></i>

                                </div>

                                <h3 class="text-3xl font-bold text-[#2d140d]">
                                    Tidak Ada Data
                                </h3>

                                <p class="text-gray-400 mt-3">
                                    Belum ada transaksi tersedia.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
                <!-- FOOT -->
        <div class="flex flex-col xl:flex-row
                    xl:items-center
                    xl:justify-between
                    gap-5 mt-8">

            <!-- INFO -->
            <div class="text-gray-500">

                Menampilkan
                <span class="font-semibold text-[#2d140d]">

                    {{ $orders->count() }}

                </span>

                transaksi

            </div>

        </div>

    </div>

</div>

<!-- SEARCH -->
<script>

    const searchInput =
        document.getElementById('searchInput');

    const rows =
        document.querySelectorAll('.report-row');

    searchInput.addEventListener('keyup', function() {

        const keyword =
            this.value.toLowerCase();

        rows.forEach(row => {

            const text =
                row.innerText.toLowerCase();

            row.style.display =
                text.includes(keyword)
                ? ''
                : 'none';

        });

    });

</script>

@endsection