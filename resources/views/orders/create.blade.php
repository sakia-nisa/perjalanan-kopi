@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    <!-- LEFT SIDE -->
    <div class="xl:col-span-2">
        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">
            <!-- SEARCH -->
            <div class="relative w-full">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search menu..."
                    class="w-full bg-white border border-[#eee]
                        rounded-2xl px-5 py-4 pl-14 outline-none
                        focus:ring-2 focus:ring-[#6b3e2e]/20">
                <i class="fa-solid fa-magnifying-glass
                        absolute left-5 top-1/2
                        -translate-y-1/2 text-gray-400"></i>
            </div>
            <!-- FILTER -->
            <form method="GET" action="/orders/create" class="flex gap-3">
                <select name="category" onchange="this.form.submit()" class="bg-white border border-[#eee] rounded-2xl px-5 py-4 outline-none">
                    <option value="">Semua Kategori</option>
                    <option value="kopi"
                        {{ request('category') == 'kopi' ? 'selected' : '' }}>
                        Coffee
                    </option>
                    <option value="non_kopi"
                        {{ request('category') == 'non_kopi' ? 'selected' : '' }}>
                        Non Coffee
                    </option>
                    <option value="snack"
                        {{ request('category') == 'snack' ? 'selected' : '' }}>
                        Snack
                    </option>
                </select>
            </form>
        </div>

        <!-- PRODUCT GRID -->
        <div class="grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-[32px] overflow-visible border border-[#eee] shadow-sm hover:shadow-xl transition duration-300">
                <!-- IMAGE --> 
                <div class="h-[260px] overflow-hidden relative">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                </div>
                <!-- BUTTON FLOAT -->
                <div class="px-4 relative -mt-16 z-20">
                    <button type="button" onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', '{{ $product->selling_price }}', '{{ asset('storage/' . $product->image) }}')"
                    class="w-full relative z-10 bg-white text-[#2d140d] py-3 rounded-2xl font-bold shadow-lg hover:bg-[#2d140d] hover:text-white transition">
                    ADD TO CART
                    </button>
                </div>
                <!-- CONTENT -->
                <div class="p-5 pt-6">
                    <!-- TOP -->
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-bold text-[#2d140d] leading-tight">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-400 capitalize text-sm mt-1">
                                {{ str_replace('_', ' ', $product->category) }}
                            </p>
                        </div>
                    <!-- STOCK -->
                    <div class="bg-[#f5ebe4] text-[#6b3e2e] text-xs font-semibold px-3 py-2 rounded-xl whitespace-nowrap">
                        {{ $product->stock }}
                    </div>
                </div>
                <!-- PRICE -->
                <div class="mt-5">
                    <p class="text-gray-400 text-sm">Price</p>
                    <h4 class="text-xl font-bold text-[#6b3e2e] mt-1">Rp {{ number_format($product->selling_price,0,',','.') }}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

    <!-- RIGHT SIDE -->
    <div>
        <form action="/orders" method="POST" id="orderForm" class="bg-white rounded-3xl p-7 shadow-sm border border-[#eee] sticky top-5">
            @csrf
            <!-- HEADER -->
            <div class="flex items-center justify-between mb-7">
                <div>
                    <h2 class="text-3xl font-bold text-[#2d140d]">Current Order</h2>
                    <p class="text-gray-400 text-sm mt-1">Customer transaction details</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-[#f5ebe4] flex items-center justify-center text-[#6b3e2e] text-xl">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>

            <!-- CUSTOMER -->
            <div class="space-y-5 mb-7">
                <div>
                    <label class="text-sm text-gray-500 mb-2 block">Customer Name</label>
                    <input type="text" name="customer_name" required class="w-full bg-[#f9f7f5] border border-[#eee] rounded-2xl px-5 py-4 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <!-- ORDER TYPE -->
                    <div>
                        <label class="text-sm text-gray-500 mb-2 block">Order Type</label>
                        <select name="order_type" required class="w-full bg-[#f9f7f5] border border-[#eee] rounded-2xl px-5 py-4 outline-none">
                            <option value="dine_in">Dine In</option>
                            <option value="take_away">Take Away</option>
                        </select>
                    </div>
                    <!-- DISCOUNT -->
                    <div>
                        <label class="text-sm text-gray-500 mb-2 block">Discount</label>
                        <input
                            type="number"
                            name="discount_amount"
                            value="0"
                            min="0"
                            class="w-full bg-[#f9f7f5]
                                border border-[#eee]
                                rounded-2xl px-5 py-4 outline-none">

                    </div>

                </div>

                <div>

                    <label class="text-sm text-gray-500 mb-2 block">
                        Notes
                    </label>

                    <textarea
                        name="note"
                        placeholder="Less sugar, less ice..."
                        class="w-full bg-[#f9f7f5]
                               border border-[#eee]
                               rounded-2xl px-5 py-4 outline-none"></textarea>

                </div>
            </div>

            <!-- CART -->
            <div id="cartItems"
                 class="space-y-4 mb-8 max-h-[400px] overflow-auto">

            </div>

            <!-- TOTAL -->
            <div class="border-t pt-6">

                <div class="flex items-center justify-between mb-3">

                    <p class="text-gray-500">
                        Grand Total
                    </p>

                    <h3 class="text-3xl font-bold text-[#6b3e2e]"
                        id="grandTotal">

                        Rp 0

                    </h3>

                </div>

                <!-- HIDDEN INPUT -->
                <div id="hiddenInputs"></div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r
                           from-[#2d140d]
                           to-[#6b3e2e]
                           hover:opacity-90
                           text-white py-5 rounded-2xl
                           text-lg font-semibold transition">

                    Checkout Order

                </button>

            </div>

        </form>

    </div>

</div>

<script>

    let cart = [];

    function addToCart(id, name, price, image) {

        const existing = cart.find(item => item.id == id);

        if (existing) {
            existing.qty += 1;
        } else {

            cart.push({
                id,
                name,
                price: parseInt(price),
                image,
                qty: 1
            });

        }

        renderCart();
    }

    function renderCart() {

        let html = '';
        let hidden = '';
        let total = 0;

        cart.forEach((item, index) => {

            total += item.price * item.qty;

            hidden += `
                <input type="hidden" name="products[]" value="${item.id}">
                <input type="hidden"
                       name="quantities[${item.id}]"
                       value="${item.qty}">
            `;

            html += `
                <div class="flex items-center justify-between
                            bg-[#f9f7f5]
                            rounded-2xl p-4">

                    <div class="flex items-center gap-3">

                        <img src="${item.image}"
                             class="w-16 h-16 rounded-xl object-cover">

                        <div>

                            <h4 class="font-semibold text-[#2d140d]">
                                ${item.name}
                            </h4>

                            <p class="text-sm text-gray-400">
                                Rp ${item.price.toLocaleString('id-ID')}
                            </p>

                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <button
                            type="button"
                            onclick="decreaseQty(${index})"
                            class="w-8 h-8 rounded-lg bg-gray-200">

                            -

                        </button>

                        <span class="font-semibold">
                            ${item.qty}
                        </span>

                        <button
                            type="button"
                            onclick="increaseQty(${index})"
                            class="w-8 h-8 rounded-lg
                                   bg-[#6b3e2e] text-white">

                            +

                        </button>

                    </div>

                </div>
            `;
        });

        document.getElementById('cartItems').innerHTML = html;

        document.getElementById('hiddenInputs').innerHTML = hidden;

        document.getElementById('grandTotal').innerHTML =
            'Rp ' + total.toLocaleString('id-ID');
    }

    function increaseQty(index) {

        cart[index].qty++;

        renderCart();
    }

    function decreaseQty(index) {

        if (cart[index].qty > 1) {
            cart[index].qty--;
        } else {
            cart.splice(index, 1);
        }

        renderCart();
    }
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function () {

        const keyword = this.value.toLowerCase();

        const cards = document.querySelectorAll('.product-card');

        cards.forEach(card => {

            const text = card.innerText.toLowerCase();

            if (text.includes(keyword)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }

        });

    });

</script>

@endsection