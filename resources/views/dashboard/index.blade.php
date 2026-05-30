@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-10">
    <h1 class="text-4xl font-bold text-[#2d140d]">Dashboard Overview ☕</h1>
    <p class="text-gray-500 mt-2">Monitor penjualan, performa menu, dan transaksi terbaru dalam satu dashboard modern.</p>
</div>
<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
    <!-- CARD -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#eee]">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Total Orders</p>
                <h2 class="text-4xl font-bold text-[#2d140d] mt-2">{{ $totalOrdersToday }}</h2>
            </div>
            <div class="w-16 h-16 rounded-2xl bg-[#f5ebe4] flex items-center justify-center text-2xl text-[#6b3e2e]">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>
    </div>
    <!-- CARD -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#eee]">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Revenue Today</p>
                <h2 class="text-3xl font-bold text-[#2d140d] mt-2">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h2>
            </div>
            <div class="w-16 h-16 rounded-2xl bg-[#e7f8ee] flex items-center justify-center text-2xl text-green-600">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>
    </div>
    <!-- CARD -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#eee]">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Profit Today</p>
                <h2 class="text-3xl font-bold text-[#2d140d] mt-2">Rp {{ number_format($profitToday, 0, ',', '.') }}</h2>
            </div>
            <div class="w-16 h-16 rounded-2xl bg-[#fff1df] flex items-center justify-center text-2xl text-yellow-600">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<!-- CHART -->
<div class="bg-white rounded-3xl p-7 shadow-sm border border-[#eee] mb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-2xl font-bold text-[#2d140d]">Sales Analytics</h3>
            <p class="text-gray-400 text-sm mt-1">Menu performance overview</p>
        </div>

        <div class="bg-[#f6f1eb] px-4 py-2 rounded-xl text-sm text-[#6b3e2e]">Weekly Report</div>
    </div>
    <canvas id="menuChart" height="100"></canvas>
</div>

<!-- TABLES -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
    <!-- BEST SELLER -->
    <div class="bg-white rounded-3xl p-7 shadow-sm border border-[#eee]">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-[#2d140d]">Best Seller Menu</h3>
                <p class="text-gray-400 text-sm mt-1">Most purchased products</p>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-[#f5ebe4] flex items-center justify-center text-[#6b3e2e] text-xl">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-left text-gray-400 text-sm border-b">
                    <th class="pb-4">Menu</th>
                    <th class="pb-4">Sold</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bestSellingMenus->take(5) as $menu)
                    <tr class="border-b last:border-none">
                        <td class="py-5 font-medium text-[#2d140d]">{{ $menu->product->name ?? '-' }}</td>
                        <td class="py-5">
                            <span class="bg-[#f5ebe4] text-[#6b3e2e] px-4 py-2 rounded-xl text-sm font-semibold">{{ $menu->total_sold }}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- RECENT ORDER -->
    <div class="bg-white rounded-3xl p-7 shadow-sm border border-[#eee]">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-[#2d140d]">Recent Orders</h3>
                <p class="text-gray-400 text-sm mt-1">Latest customer transactions</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-[#e7f8ee] flex items-center justify-center text-green-600 text-xl">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-left text-gray-400 text-sm border-b">
                    <th class="pb-4">Customer</th>
                    <th class="pb-4">Total</th>
                    <th class="pb-4">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentOrders->take(10) as $order)
                    <tr class="border-b last:border-none">
                        <td class="py-5 font-medium text-[#2d140d]">{{ $order->customer_name }}</td>
                        <td class="py-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="py-5">
                            <span class="px-4 py-2 rounded-xl text-sm font-medium
                                @if($order->status == 'completed')
                                    bg-green-100 text-green-700
                                @elseif($order->status == 'pending')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-blue-100 text-blue-700
                                @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    const ctx = document.getElementById('menuChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Total Sold',
                data: @json($chartData),
                backgroundColor: '#6b3e2e',
                borderRadius: 12,
            }]
        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection