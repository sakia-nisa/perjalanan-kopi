<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Receipt #{{ $order->id }}
    </title>

    @vite('resources/css/app.css')

    <style>

        body{
            background:#f5f5f5;
            font-family:sans-serif;
        }

        @media print {

            body{
                background:white;
            }

            .no-print{
                display:none;
            }

            .receipt-wrapper{
                box-shadow:none !important;
                border:none !important;
            }

        }

    </style>

</head>

<body class="py-10">

<div class="max-w-xl mx-auto">

    <!-- RECEIPT -->
    <div class="receipt-wrapper bg-white
                rounded-[28px]
                border border-[#eee]
                shadow-sm p-10">

        <!-- LOGO -->
        <div class="text-center">

            <h1 class="text-5xl font-black
                       tracking-wide text-[#2d140d]">

                PERJALANAN KOPI

            </h1>

            <div class="w-16 h-[2px]
                        bg-[#999]
                        mx-auto my-6"></div>

            <p class="text-2xl text-[#2d140d]">
                Rasa dalam setiap perjalanan
            </p>

            <div class="mt-10 space-y-4
                        text-[30px] text-[#2d140d]">

                <p>
                    Jln. Srikaton Tengah No.7 RT.06/RW.07
                </p>

                <p>
                    WhatsApp: 0857-7746-9269
                </p>

                <p>
                    Instagram: @perjalanankopi_
                </p>

            </div>

        </div>

        <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-12"></div>

        <!-- INFO -->
         <div class="space-y-8 text-[32px]">

            <!-- NO ORDER -->
            <div class="grid grid-cols-[220px_30px_1fr] gap-2">

                <span class="font-bold">
                    No Order
                </span>

                <span>:</span>

                <span>
                    {{ $order->id }}
                </span>

            </div>

            <!-- CUSTOMER -->
            <div class="grid grid-cols-[220px_30px_1fr] gap-2">

                <span class="font-bold">
                    Customer
                </span>

                <span>:</span>

                <span>
                    {{ $order->customer_name }}
                </span>

            </div>

            <!-- TYPE -->
            <div class="grid grid-cols-[220px_30px_1fr] gap-2">

                <span class="font-bold">
                    Tipe Order
                </span>

                <span>:</span>

                <span>
                    {{ $order->order_type }}
                </span>

            </div>

            <!-- NOTE -->
            <div class="grid grid-cols-[220px_30px_1fr] gap-2">

                <span class="font-bold">
                    Catatan
                </span>

                <span>:</span>

                <span>
                    {{ $order->note ?? '-' }}
                </span>

            </div>

            <!-- TIME -->
            <div class="grid grid-cols-[220px_30px_1fr] gap-2">

                <span class="font-bold">
                    Waktu
                </span>

                <span>:</span>

                <span>
                    {{ \Carbon\Carbon::parse($order->order_time)->format('d-m-Y H:i:s') }}
                </span>

            </div>

        </div>

        <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-12"></div>

        <!-- TABLE -->
        <table class="w-full text-[28px]">

            <thead>

                <tr class="border-b-4 border-dashed border-[#444]">

                    <th class="text-left pb-5">
                        MENU
                    </th>

                    <th class="text-center pb-5">
                        QTY
                    </th>

                    <th class="text-right pb-5">
                        SUBTOTAL
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($order->items as $item)

                <tr>

                    <td class="py-8">

                        {{ $loop->iteration }}.
                        {{ $item->product->name }}

                    </td>

                    <td class="text-center py-8">

                        {{ $item->quantity }}

                    </td>

                    <td class="text-right py-8">

                        Rp {{ number_format($item->subtotal,0,',','.') }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>
                <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-10"></div>

        <!-- DISCOUNT -->
        <div class="flex items-center justify-between
                    text-[30px] mb-8">

            <h3 class="font-bold text-[#2d140d]">
                Diskon
            </h3>

            <h3 class="text-[#2d140d]">

                Rp {{ number_format($order->discount_amount ?? 0,0,',','.') }}

            </h3>

        </div>

        <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-10"></div>

        <!-- TOTAL -->
        <div class="flex items-center justify-between
                    text-[38px]">

            <h3 class="font-black text-[#2d140d]">
                Total
            </h3>

            <h3 class="font-black text-[#2d140d]">

                Rp {{ number_format($order->total_price,0,',','.') }}

            </h3>

        </div>

        <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-10"></div>

        @if($order->payment)

        <!-- PAYMENT -->
        <div class="space-y-8 text-[30px]">

            <div class="flex items-center justify-between">

                <h3 class="font-bold text-[#2d140d]">
                    Metode Bayar
                </h3>

                <h3 class="text-[#2d140d]">

                    {{ $order->payment->payment_method }}

                </h3>

            </div>

            <div class="flex items-center justify-between">

                <h3 class="font-bold text-[#2d140d]">
                    Bayar
                </h3>

                <h3 class="text-[#2d140d]">

                    Rp {{ number_format($order->payment->amount_paid,0,',','.') }}

                </h3>

            </div>

            <div class="flex items-center justify-between">

                <h3 class="font-bold text-[#2d140d]">
                    Kembalian
                </h3>

                <h3 class="text-[#2d140d]">

                    Rp {{ number_format($order->payment->change_amount,0,',','.') }}

                </h3>

            </div>

        </div>

        @endif

        <!-- LINE -->
        <div class="border-t-4 border-dashed
                    border-[#444] my-12"></div>

        <!-- FOOTER -->
        <div class="text-center">

            <p class="text-[28px] text-[#2d140d] leading-relaxed">

                Terima kasih sudah berkunjung.

                <br><br>

                Simpan struk ini sebagai bukti pembayaran.

            </p>

        </div>

        <!-- BUTTON -->
        <div class="mt-12 space-y-5 no-print">

            <!-- PRINT -->
            <button
                onclick="window.print()"
                class="w-full bg-gradient-to-r
                       from-[#2d140d]
                       to-[#6b3e2e]
                       hover:opacity-90
                       text-white py-6 rounded-2xl
                       text-2xl font-semibold
                       flex items-center justify-center gap-4
                       transition">

                <i class="fa-solid fa-print"></i>

                Print Struk

            </button>

            <!-- DONE -->
            <a href="/orders"
               class="w-full bg-gradient-to-r
                      from-[#2d140d]
                      to-[#6b3e2e]
                      hover:opacity-90
                      text-white py-6 rounded-2xl
                      text-2xl font-semibold
                      flex items-center justify-center gap-4
                      transition">

                <i class="fa-regular fa-circle-check"></i>

                Transaksi Selesai

            </a>

        </div>

    </div>

</div>

</body>
</html>