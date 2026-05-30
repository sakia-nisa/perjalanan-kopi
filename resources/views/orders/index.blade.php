@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-10">

    <div>

        <h1 class="text-5xl font-bold text-[#2d140d]">
            Riwayat Pesanan
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Kelola seluruh transaksi customer coffee shop.
        </p>

    </div>

    <!-- BUTTON -->
    <a href="/orders/create"
       class="bg-gradient-to-r
              from-[#2d140d]
              to-[#6b3e2e]
              hover:opacity-90
              text-white px-7 py-4
              rounded-2xl font-semibold
              flex items-center justify-center gap-3 transition">

        <i class="fa-solid fa-plus"></i>

        Buat Order

    </a>

</div>

<!-- CARD -->
<div class="bg-white rounded-[32px]
            border border-[#eee]
            shadow-sm p-6">

    <!-- FILTER -->
    <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-8">

        <!-- SEARCH -->
        <div class="relative w-full lg:max-w-md">

            <input
                type="text"
                id="searchInput"
                placeholder="Cari customer..."
                class="w-full bg-white border border-[#eee]
                       rounded-2xl px-5 py-4 pl-14 outline-none
                       focus:ring-2 focus:ring-[#6b3e2e]/20">

            <i class="fa-solid fa-magnifying-glass
                      absolute left-5 top-1/2
                      -translate-y-1/2 text-gray-400"></i>

        </div>

        <!-- STATUS FILTER -->
        <select
            id="statusFilter"
            class="bg-white border border-[#eee]
                   rounded-2xl px-5 py-4 outline-none">

            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="ready">Ready</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>

        </select>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <!-- HEAD -->
            <thead>

                <tr class="bg-[#f8f2ee] text-[#2d140d]">

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
                        Status
                    </th>

                    <th class="text-left px-6 py-5">
                        Tanggal
                    </th>

                    <th class="text-left px-6 py-5 rounded-r-2xl">
                        Aksi
                    </th>

                </tr>

            </thead>

            <!-- BODY -->
            <tbody id="tableBody">

                @foreach($orders as $order)

                    <tr class="border-b border-[#f2f2f2]
                               hover:bg-[#fcfaf8]
                               transition order-row">

                        <!-- NO -->
                        <td class="px-6 py-5">
                            {{ $loop->iteration }}
                        </td>

                        <!-- CUSTOMER -->
                        <td class="px-6 py-5">

                            <div>

                                <h3 class="font-semibold text-lg text-[#2d140d] customer-name">
                                    {{ $order->customer_name }}
                                </h3>

                                <p class="text-sm text-gray-400">
                                    #INV-{{ $order->id }}
                                </p>

                            </div>

                        </td>

                        <!-- ORDER TYPE -->
                        <td class="px-6 py-5 capitalize">

                            {{ str_replace('_', ' ', $order->order_type) }}

                        </td>

                        <!-- TOTAL -->
                        <td class="px-6 py-5 font-semibold">

                            Rp {{ number_format($order->total_price,0,',','.') }}

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5 status-name">

                            <span class="
                                px-4 py-2 rounded-xl text-sm font-medium

                                @if($order->status == 'completed')
                                    bg-[#edf7e7] text-[#5f9c47]
                                @elseif($order->status == 'pending')
                                    bg-[#fff4df] text-[#d89b28]
                                @elseif($order->status == 'processing')
                                    bg-[#e7f0ff] text-[#3d7ef0]
                                @elseif($order->status == 'ready')
                                    bg-[#ececec] text-[#5a5a5a]
                                @else
                                    bg-[#fdecec] text-red-500
                                @endif
                            ">

                                {{ ucfirst($order->status) }}

                            </span>

                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-5 text-gray-500">

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex flex-wrap items-center gap-2">

                                <!-- DETAIL -->
                                <a href="/orders/{{ $order->id }}/detail"
                                   class="border border-[#d8c7bb]
                                          hover:bg-[#f5ebe4]
                                          text-[#6b3e2e]
                                          px-4 py-2 rounded-xl
                                          text-sm flex items-center gap-2 transition">

                                    <i class="fa-solid fa-eye"></i>

                                    Detail

                                </a>

                                @if($order->status != 'completed')

                                    <!-- EDIT -->
                                    <a href="/orders/{{ $order->id }}/edit"
                                       class="border border-yellow-200
                                              hover:bg-yellow-50
                                              text-yellow-600
                                              px-4 py-2 rounded-xl
                                              text-sm flex items-center gap-2 transition">

                                        <i class="fa-solid fa-pen"></i>

                                        Edit

                                    </a>

                                    <!-- PAYMENT -->
                                    <a href="/orders/{{ $order->id }}/payment"
                                       class="bg-green-500 hover:bg-green-600
                                              text-white px-4 py-2
                                              rounded-xl text-sm transition">

                                        Bayar

                                    </a>

                                @else

                                    <!-- RECEIPT -->
                                    <a href="/orders/{{ $order->id }}/receipt"
                                       class="bg-[#6b3e2e] hover:bg-[#2d140d]
                                              text-white px-4 py-2
                                              rounded-xl text-sm transition">

                                        Struk

                                    </a>

                                @endif

                                <!-- DELETE -->
                                <form
                                    action="/orders/{{ $order->id }}"
                                    method="POST"
                                    class="confirm-form"
                                    data-title="Hapus Order"
                                    data-message="Yakin hapus order ini?">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="border border-red-200
                                               hover:bg-red-50
                                               text-red-500 px-4 py-2
                                               rounded-xl text-sm transition">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- PAGINATION -->
<div class="mt-10 flex flex-col items-center gap-4">

    {{ $orders->links('pagination::tailwind') }}

    <p class="text-gray-500">

        Showing {{ $orders->firstItem() }}
        to {{ $orders->lastItem() }}
        of {{ $orders->total() }} results

    </p>

</div>

<!-- SEARCH & FILTER -->
<script>

    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');

    function filterTable() {

        const keyword = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        const rows = document.querySelectorAll('.order-row');

        rows.forEach(row => {

            const text = row.innerText.toLowerCase();

            const rowStatus =
                row.querySelector('.status-name')
                   .innerText
                   .toLowerCase();

            const matchKeyword = text.includes(keyword);

            const matchStatus =
                status === '' || rowStatus.includes(status);

            if (matchKeyword && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    }

    searchInput.addEventListener('keyup', filterTable);
    statusFilter.addEventListener('change', filterTable);

</script>

@endsection