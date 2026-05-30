<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Print Report
    </title>

    @vite('resources/css/app.css')

    <style>

        body{
            font-family:sans-serif;
            background:#f5f5f5;
            font-size:12px;
            line-height:1.3;
        }
        table{
            font-size:11px;
        }
        th, td{
            padding-top:10px !important;
            padding-bottom:10px !important;}
            @page{
                size:A4 portrait;
                margin:10mm;
            }
        @media print {

            body{
                background:white;
            }

            .no-print{
                display:none;
            }

            .print-wrapper{
                box-shadow:none !important;
                border:none !important;
            }

        }

    </style>

</head>

<body class="py-10">

<div class="max-w-[1700px] mx-auto px-5">

    <!-- ACTION -->
    <div class="flex items-center justify-end gap-4 mb-6 no-print">

        <button
            onclick="window.print()"
            class="bg-gradient-to-r
                   from-[#2d140d]
                   to-[#6b3e2e]
                   hover:opacity-90
                   text-white px-6 py-4
                   rounded-2xl font-semibold transition">

            Print Report

        </button>

        <a href="/reports"
           class="bg-white border border-[#eee]
                  hover:bg-[#faf7f5]
                  px-6 py-4 rounded-2xl
                  font-semibold transition">

            Kembali

        </a>

    </div>

    <!-- WRAPPER -->
    <div class="print-wrapper bg-white
            rounded-[20px]
            border border-[#eee]
            shadow-sm p-5">

        <!-- HEADER -->
        <div class="flex items-start justify-between gap-10 mb-12">

            <!-- LEFT -->
            <div>

                <h1 class="text-3xl font-black text-[#2d140d]">
                    PERJALANAN KOPI
                </h1>

                <p class="text-gray-500 mt-4 text-xl">
                    Laporan Penjualan Cafe
                </p>

                <div class="mt-6 text-gray-500 space-y-2">

                    <p>
                        Jln. Srikaton Tengah No.7
                    </p>

                    <p>
                        WhatsApp: 0857-7746-9269
                    </p>

                    <p>
                        Instagram: @perjalanankopi_
                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="text-right">

                <p class="text-gray-500 mt-4">

                    {{ now()->format('d M Y H:i') }}

                </p>

                @if(request('start_date') || request('end_date'))

                <div class="mt-6 text-gray-500">

                    <p>
                        {{ request('start_date') ?? '-' }}
                    </p>

                    <p class="my-2">
                        sampai
                    </p>

                    <p>
                        {{ request('end_date') ?? '-' }}
                    </p>

                </div>

                @endif

            </div>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-4 gap-3 mb-6">

            <!-- ORDER -->
            <div class="bg-[#faf7f5]
                        rounded-[28px]
                        p-6">

                <p class="text-gray-400">
                    Total Order
                </p>

                <h3 class="text-xl font-bold
                           text-[#2d140d] mt-4">

                    {{ $totalOrders }}

                </h3>

            </div>

            <!-- ITEM -->
            <div class="bg-[#faf7f5]
                        rounded-[28px]
                        p-6">

                <p class="text-gray-400">
                    Item Terjual
                </p>

                <h3 class="text-xl font-bold
                           text-[#2d140d] mt-4">

                    {{ $totalItemsSold }}

                </h3>

            </div>

            <!-- INCOME -->
            <div class="bg-[#faf7f5]
                        rounded-[28px]
                        p-6">

                <p class="text-gray-400">
                    Pendapatan
                </p>

                <h3 class="text-xl font-bold
                           text-[#2d140d] mt-4">

                    Rp {{ number_format($totalIncome,0,',','.') }}

                </h3>

            </div>

            <!-- PROFIT -->
            <div class="bg-[#faf7f5]
                        rounded-[28px]
                        p-6">

                <p class="text-gray-400">
                    Profit
                </p>

                <h3 class="text-xl font-bold
                           text-green-600 mt-4">

                    Rp {{ number_format($totalProfit,0,',','.') }}

                </h3>

            </div>

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
                            Customer
                        </th>

                        <th class="text-left px-6 py-5">
                            Order Type
                        </th>

                        <th class="text-left px-6 py-5">
                            Total
                        </th>

                        <th class="text-left px-6 py-5">
                            Profit
                        </th>

                        <th class="text-left px-6 py-5">
                            Payment
                        </th>

                        <th class="text-left px-6 py-5 rounded-r-2xl">
                            Waktu
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($orders as $order)

                    @php

                        $profit =
                            $order->items->sum(function($item){

                                return
                                    ($item->selling_price - $item->hpp)
                                    * $item->quantity;

                            });

                    @endphp

                    <tr class="border-b border-[#f1f1f1]">

                        <td class="px-3 py-3">

                            #{{ $order->id }}

                        </td>

                        <td class="px-3 py-3">

                            {{ $order->customer_name }}

                        </td>
                        <td class="px-3 py-3">

                            <span class="capitalize">

                                {{ str_replace('_', ' ', $order->order_type) }}

                            </span>

                        </td>

                        <td class="px-6 py-6 font-semibold text-[#2d140d]">

                            Rp {{ number_format($order->total_price,0,',','.') }}

                        </td>

                        <td class="px-6 py-6 font-semibold text-green-600">

                            Rp {{ number_format($profit,0,',','.') }}

                        </td>

                        <td class="px-3 py-3">

                            {{ $order->payment->payment_method ?? '-' }}

                        </td>

                        <td class="px-6 py-6 text-gray-500">

                            {{ \Carbon\Carbon::parse($order->order_time)->format('d M Y H:i') }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- FOOTER -->
        <div class="mt-16">

            <div class="border-t border-dashed border-[#999] pt-8">

                <div class="flex items-end justify-between">

                    <!-- LEFT -->
                    <div>

                        <p class="text-gray-500">
                            Dicetak oleh sistem Perjalanan Kopi
                        </p>

                        <p class="text-gray-400 mt-2">
                            {{ now()->format('d M Y H:i:s') }}
                        </p>

                    </div>

                    <!-- RIGHT -->
                    <div class="text-center">

                        <p class="text-[#2d140d] font-semibold">
                            Admin
                        </p>

                        <div class="h-24"></div>

                        <div class="w-52 border-t border-[#999] pt-2">

                            Perjalanan Kopi

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>