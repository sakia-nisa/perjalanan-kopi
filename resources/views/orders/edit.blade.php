@extends('layouts.app')

@section('content')

@php
    $selectedItems = $order->items->keyBy('product_id');
@endphp

<form
    action="/orders/{{ $order->id }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- LEFT -->
        <div class="xl:col-span-2">

            <!-- TOP -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

                <!-- TITLE -->
                <div>

                    <h1 class="text-5xl font-bold text-[#2d140d]">
                        Edit Pesanan
                    </h1>

                    <p class="text-gray-500 mt-2 text-lg">
                        Edit menu dan pesanan customer secara realtime.
                    </p>

                </div>

                <!-- SEARCH -->
                <div class="relative w-full lg:max-w-md">

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search menu..."
                        class="w-full bg-white border border-[#eee]
                               rounded-2xl px-5 py-4 pl-14 outline-none">

                    <i class="fa-solid fa-magnifying-glass
                              absolute left-5 top-1/2
                              -translate-y-1/2 text-gray-400"></i>

                </div>

            </div>

            <!-- PRODUCT GRID -->
            <div
                id="productGrid"
                class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8">

                @foreach($products as $product)

                @php
                    $selected = $selectedItems->has($product->id);
                    $qty = $selected
                        ? $selectedItems[$product->id]->quantity
                        : 1;
                @endphp

                <!-- CARD -->
                <div
                    class="product-card bg-white
                           rounded-[40px]
                           overflow-visible
                           border border-[#eee]
                           shadow-sm hover:shadow-xl
                           transition duration-300"

                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $product->selling_price }}"
                    data-product-image="{{ asset('storage/' . $product->image) }}">

                    <!-- IMAGE -->
                    <div class="relative">

                        <div class="h-[340px]
                                    overflow-hidden
                                    rounded-t-[40px]">

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover">

                        </div>

                        <!-- BUTTON -->
                        <div class="absolute -bottom-7 left-0 right-0 px-5 z-20">

                            <button
                                type="button"
                                class="add-to-cart-btn
                                       w-full rounded-2xl py-4
                                       font-bold shadow-xl transition

                                       {{ $selected
                                            ? 'bg-[#2d140d] text-white'
                                            : 'bg-white text-[#2d140d]' }}">

                                {{ $selected
                                    ? $qty . ' Pesanan Dipilih'
                                    : 'ADD TO CART' }}

                            </button>

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="px-5 pb-5 pt-14">

                        <!-- TOP -->
                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h3 class="text-2xl font-bold text-[#2d140d]">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-400 capitalize mt-1">
                                    {{ str_replace('_', ' ', $product->category) }}
                                </p>

                            </div>

                            <!-- STOCK -->
                            <div class="bg-[#f5ebe4]
                                        text-[#6b3e2e]
                                        text-sm font-semibold
                                        px-3 py-2 rounded-xl">

                                {{ $product->stock }}

                            </div>

                        </div>

                        <!-- PRICE -->
                        <div class="mt-5 flex items-center justify-between">

                            <div>

                                <p class="text-gray-400 text-sm">
                                    Price
                                </p>

                                <h4 class="text-2xl font-bold text-[#6b3e2e]">

                                    Rp {{ number_format($product->selling_price,0,',','.') }}

                                </h4>

                            </div>

                            <!-- QTY -->
                            <div class="flex items-center gap-3
                                        bg-[#faf7f5]
                                        px-4 py-3 rounded-2xl">

                                <button
                                    type="button"
                                    class="minus-btn text-[#6b3e2e]
                                           text-lg font-bold">

                                    -

                                </button>

                                <input
                                    type="number"
                                    value="{{ $qty }}"
                                    min="1"
                                    class="qty-input w-12 text-center
                                           bg-transparent outline-none
                                           font-semibold text-[#2d140d]">

                                <button
                                    type="button"
                                    class="plus-btn text-[#6b3e2e]
                                           text-lg font-bold">

                                    +

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>
        <!-- RIGHT -->
        <div>

            <!-- CURRENT ORDER -->
            <div class="bg-white rounded-[36px]
                        border border-[#eee]
                        shadow-sm p-7 sticky top-28">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h2 class="text-3xl font-bold text-[#2d140d]">
                            Current Order
                        </h2>

                        <p class="text-gray-400 mt-2">
                            #INV-{{ $order->id }}
                        </p>

                    </div>

                    <div class="w-14 h-14 rounded-2xl
                                bg-[#f8f2ee]
                                flex items-center justify-center">

                        <i class="fa-solid fa-cart-shopping
                                  text-[#6b3e2e] text-xl"></i>

                    </div>

                </div>

                <!-- CUSTOMER -->
                <div class="space-y-5 mb-8">

                    <!-- NAME -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Customer Name
                        </label>

                        <input
                            type="text"
                            name="customer_name"
                            value="{{ $order->customer_name }}"
                            required
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                    </div>

                    <!-- ORDER TYPE -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Order Type
                        </label>

                        <select
                            name="order_type"
                            required
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                            <option value="dine_in"
                                {{ $order->order_type == 'dine_in' ? 'selected' : '' }}>

                                Dine In

                            </option>

                            <option value="take_away"
                                {{ $order->order_type == 'take_away' ? 'selected' : '' }}>

                                Take Away

                            </option>

                        </select>

                    </div>

                    <!-- NOTE -->
                    <div>

                        <label class="text-sm text-gray-500 mb-3 block">
                            Catatan
                        </label>

                        <textarea
                            name="note"
                            rows="3"
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4
                                   outline-none resize-none">{{ $order->note }}</textarea>

                    </div>

                </div>

                <!-- CART ITEMS -->
                <div
                    id="cartItems"
                    class="space-y-4 max-h-[500px] overflow-y-auto pr-2">

                    @foreach($order->items as $item)

                    <div
                        class="cart-item bg-[#faf7f5]
                               rounded-3xl p-4"
                        data-product-id="{{ $item->product_id }}">

                        <div class="flex gap-4">

                            <!-- IMAGE -->
                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-24 h-24 rounded-3xl object-cover">

                            <!-- CONTENT -->
                            <div class="flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div>

                                        <h3 class="font-bold text-[#2d140d] text-lg">
                                            {{ $item->product->name }}
                                        </h3>

                                        <p class="text-[#6b3e2e]
                                                  font-semibold mt-1">

                                            Rp {{ number_format($item->selling_price,0,',','.') }}

                                        </p>

                                    </div>

                                    <!-- REMOVE -->
                                    <button
                                        type="button"
                                        class="remove-cart-item
                                               text-red-400 hover:text-red-600">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </div>

                                <!-- QTY -->
                                <div class="flex items-center gap-3 mt-4">

                                    <button
                                        type="button"
                                        class="cart-minus w-9 h-9
                                               rounded-xl bg-white">

                                        -

                                    </button>

                                    <input
                                        type="number"
                                        name="quantities[{{ $item->product_id }}]"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        class="cart-qty w-14 text-center
                                               bg-white rounded-xl py-2 outline-none">

                                    <button
                                        type="button"
                                        class="cart-plus w-9 h-9
                                               rounded-xl bg-white">

                                        +

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- CHECKBOX -->
                        <input
                            type="checkbox"
                            name="products[]"
                            value="{{ $item->product_id }}"
                            checked
                            class="hidden real-checkbox">

                    </div>

                    @endforeach

                </div>
                                <!-- EMPTY -->
                <div
                    id="emptyCart"
                    class="{{ $order->items->count() ? 'hidden' : '' }}
                           text-center py-16">

                    <div class="w-24 h-24 rounded-full
                                bg-[#f8f2ee]
                                flex items-center justify-center
                                mx-auto mb-5">

                        <i class="fa-solid fa-cart-shopping
                                  text-4xl text-[#6b3e2e]"></i>

                    </div>

                    <h3 class="text-2xl font-bold text-[#2d140d]">
                        Cart Empty
                    </h3>

                    <p class="text-gray-400 mt-2">
                        Pilih menu untuk memulai order.
                    </p>

                </div>

                <!-- SUMMARY -->
                <div class="border-t border-dashed mt-8 pt-8">

                    <!-- STATUS -->
                    <div class="mb-5">

                        <label class="text-sm text-gray-500 mb-3 block">
                            Status Pesanan
                        </label>

                        <select
                            name="status"
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                            <option value="pending"
                                {{ $order->status == 'pending' ? 'selected' : '' }}>

                                Pending

                            </option>

                            <option value="processing"
                                {{ $order->status == 'processing' ? 'selected' : '' }}>

                                Processing

                            </option>

                            <option value="ready"
                                {{ $order->status == 'ready' ? 'selected' : '' }}>

                                Ready

                            </option>

                            <option value="completed"
                                {{ $order->status == 'completed' ? 'selected' : '' }}>

                                Completed

                            </option>

                        </select>

                    </div>

                    <!-- DISCOUNT -->
                    <div class="mb-6">

                        <label class="text-sm text-gray-500 mb-3 block">
                            Discount
                        </label>

                        <input
                            type="number"
                            name="discount_amount"
                            value="{{ $order->discount_amount }}"
                            min="0"
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-4 outline-none">

                    </div>

                    <!-- TOTAL -->
                    <div class="space-y-4 mb-8">

                        <div class="flex items-center justify-between">

                            <p class="text-gray-500">
                                Total Item
                            </p>

                            <h3
                                id="totalItem"
                                class="font-semibold text-[#2d140d]">

                                {{ $order->items->count() }}

                            </h3>

                        </div>

                        <div class="flex items-center justify-between">

                            <p class="text-xl font-bold text-[#2d140d]">
                                Total
                            </p>

                            <h3
                                id="grandTotal"
                                class="text-3xl font-bold text-[#6b3e2e]">

                                Rp {{ number_format($order->total_price,0,',','.') }}

                            </h3>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r
                               from-[#2d140d]
                               to-[#6b3e2e]
                               hover:opacity-90
                               text-white py-5 rounded-2xl
                               text-xl font-semibold transition">

                        Update Order

                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

<!-- SEARCH -->
<script>

    const searchInput =
        document.getElementById('searchInput');

    const productCards =
        document.querySelectorAll('.product-card');

    searchInput.addEventListener('keyup', function() {

        const keyword =
            this.value.toLowerCase();

        productCards.forEach(card => {

            const text =
                card.innerText.toLowerCase();

            card.style.display =
                text.includes(keyword)
                ? ''
                : 'none';

        });

    });

</script>
<script>

    const cartItems =
        document.getElementById('cartItems');

    const emptyCart =
        document.getElementById('emptyCart');

    // ADD TO CART
    document.querySelectorAll('.product-card')
        .forEach(card => {

        const button =
            card.querySelector('.add-to-cart-btn');

        const qtyInput =
            card.querySelector('.qty-input');

        const productId =
            card.dataset.productId;

        const productName =
            card.dataset.productName;

        const productPrice =
            card.dataset.productPrice;

        const productImage =
            card.dataset.productImage;

        // PLUS
        card.querySelector('.plus-btn')
            .addEventListener('click', () => {

            qtyInput.value =
                parseInt(qtyInput.value) + 1;

            updateButton();

        });

        // MINUS
        card.querySelector('.minus-btn')
            .addEventListener('click', () => {

            if (qtyInput.value > 1) {
                qtyInput.value =
                    parseInt(qtyInput.value) - 1;
            }

            updateButton();

        });

        function updateButton() {

            if (button.classList.contains('bg-[#2d140d]')) {

                button.innerText =
                    qtyInput.value + ' Pesanan Dipilih';

            }

        }
                // CLICK BUTTON
        button.addEventListener('click', () => {

            // SELECTED
            if (button.classList.contains('bg-[#2d140d]')) {

                button.classList.remove(
                    'bg-[#2d140d]',
                    'text-white'
                );

                button.classList.add(
                    'bg-white',
                    'text-[#2d140d]'
                );

                button.innerText =
                    'ADD TO CART';

                // REMOVE CART
                const cartItem =
                    document.querySelector(
                        `.cart-item[data-product-id="${productId}"]`
                    );

                if (cartItem) {
                    cartItem.remove();
                }

            } else {

                // ACTIVE BUTTON
                button.classList.remove(
                    'bg-white',
                    'text-[#2d140d]'
                );

                button.classList.add(
                    'bg-[#2d140d]',
                    'text-white'
                );

                button.innerText =
                    qtyInput.value + ' Pesanan Dipilih';

                // CREATE CART
                const cartHTML = `
                    <div
                        class="cart-item bg-[#faf7f5]
                               rounded-3xl p-4"
                        data-product-id="${productId}">

                        <div class="flex gap-4">

                            <!-- IMAGE -->
                            <img
                                src="${productImage}"
                                class="w-24 h-24 rounded-3xl object-cover">

                            <!-- CONTENT -->
                            <div class="flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div>

                                        <h3 class="font-bold text-[#2d140d] text-lg">
                                            ${productName}
                                        </h3>

                                        <p class="text-[#6b3e2e]
                                                  font-semibold mt-1">

                                            Rp ${Number(productPrice).toLocaleString('id-ID')}

                                        </p>

                                    </div>

                                    <!-- REMOVE -->
                                    <button
                                        type="button"
                                        class="remove-cart-item
                                               text-red-400 hover:text-red-600">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </div>

                                <!-- QTY -->
                                <div class="flex items-center gap-3 mt-4">

                                    <button
                                        type="button"
                                        class="cart-minus w-9 h-9
                                               rounded-xl bg-white">

                                        -

                                    </button>

                                    <input
                                        type="number"
                                        name="quantities[${productId}]"
                                        value="${qtyInput.value}"
                                        min="1"
                                        class="cart-qty w-14 text-center
                                               bg-white rounded-xl py-2 outline-none">

                                    <button
                                        type="button"
                                        class="cart-plus w-9 h-9
                                               rounded-xl bg-white">

                                        +

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- CHECKBOX -->
                        <input
                            type="checkbox"
                            name="products[]"
                            value="${productId}"
                            checked
                            class="hidden real-checkbox">

                    </div>
                `;

                cartItems.insertAdjacentHTML(
                    'beforeend',
                    cartHTML
                );

            }

            updateEmpty();
            attachCartEvents();

        });

    });

    // EMPTY
    function updateEmpty() {

        const items =
            document.querySelectorAll('.cart-item');

        if (items.length > 0) {

            emptyCart.classList.add('hidden');

        } else {

            emptyCart.classList.remove('hidden');

        }

        document.getElementById('totalItem')
            .innerText = items.length;

    }

    // CART EVENTS
    function attachCartEvents() {

        document.querySelectorAll('.cart-item')
            .forEach(item => {

            // REMOVE
            item.querySelector('.remove-cart-item')
                ?.addEventListener('click', () => {

                const productId =
                    item.dataset.productId;

                // REMOVE CARD ACTIVE
                document.querySelectorAll('.product-card')
                    .forEach(card => {

                    if (
                        card.dataset.productId
                        === productId
                    ) {

                        const button =
                            card.querySelector(
                                '.add-to-cart-btn'
                            );

                        button.classList.remove(
                            'bg-[#2d140d]',
                            'text-white'
                        );

                        button.classList.add(
                            'bg-white',
                            'text-[#2d140d]'
                        );

                        button.innerText =
                            'ADD TO CART';

                    }

                });

                item.remove();

                updateEmpty();

            });

            // PLUS
            item.querySelector('.cart-plus')
                ?.addEventListener('click', () => {

                const qty =
                    item.querySelector('.cart-qty');

                qty.value =
                    parseInt(qty.value) + 1;

            });

            // MINUS
            item.querySelector('.cart-minus')
                ?.addEventListener('click', () => {

                const qty =
                    item.querySelector('.cart-qty');

                if (qty.value > 1) {

                    qty.value =
                        parseInt(qty.value) - 1;

                }

            });

        });

    }

    attachCartEvents();

</script>

@endsection