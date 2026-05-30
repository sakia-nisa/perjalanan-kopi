<?php $__env->startSection('content'); ?>

<div class="max-w-[1700px] mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-10">

        <!-- TITLE -->
        <div>

            <h1 class="text-5xl font-bold text-[#2d140d]">
                Pembayaran Pesanan
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Selesaikan transaksi customer dengan sistem pembayaran modern.
            </p>

        </div>

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

    </div>

    <form
        action="/orders/<?php echo e($order->id); ?>/payment"
        method="POST">

        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="xl:col-span-2 space-y-8">

                <!-- CUSTOMER -->
                <div class="bg-white rounded-[36px]
                            border border-[#eee]
                            shadow-sm p-8">

                    <!-- TOP -->
                    <div class="flex items-center gap-3 mb-8">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-[#f8f2ee]
                                    flex items-center justify-center">

                            <i class="fa-regular fa-user
                                      text-[#6b3e2e] text-xl"></i>

                        </div>

                        <h2 class="text-3xl font-bold text-[#2d140d]">
                            Informasi Customer
                        </h2>

                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- CUSTOMER -->
                        <div class="bg-[#faf7f5]
                                    rounded-3xl p-6">

                            <p class="text-gray-400">
                                Customer Name
                            </p>

                            <h3 class="text-2xl font-bold
                                       text-[#2d140d] mt-3">

                                <?php echo e($order->customer_name); ?>


                            </h3>

                        </div>

                        <!-- ORDER TYPE -->
                        <div class="bg-[#faf7f5]
                                    rounded-3xl p-6">

                            <p class="text-gray-400">
                                Order Type
                            </p>

                            <h3 class="text-2xl font-bold
                                       text-[#2d140d] mt-3 capitalize">

                                <?php echo e(str_replace('_', ' ', $order->order_type)); ?>


                            </h3>

                        </div>

                    </div>

                </div>

                <!-- ORDER ITEMS -->
                <div class="bg-white rounded-[36px]
                            border border-[#eee]
                            shadow-sm p-8">

                    <!-- TOP -->
                    <div class="flex items-center gap-3 mb-8">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-[#f8f2ee]
                                    flex items-center justify-center">

                            <i class="fa-solid fa-cart-shopping
                                      text-[#6b3e2e] text-xl"></i>

                        </div>

                        <h2 class="text-3xl font-bold text-[#2d140d]">
                            Order Items
                        </h2>

                    </div>

                    <!-- ITEMS -->
                    <div class="space-y-5">

                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="bg-[#faf7f5]
                                    rounded-[32px]
                                    p-5">

                            <div class="flex gap-5">

                                <!-- IMAGE -->
                                <img
                                    src="<?php echo e(asset('storage/' . $item->product->image)); ?>"
                                    class="w-28 h-28 rounded-3xl object-cover">

                                <!-- CONTENT -->
                                <div class="flex-1">

                                    <div class="flex items-start justify-between gap-5">

                                        <div>

                                            <h3 class="text-2xl font-bold text-[#2d140d]">
                                                <?php echo e($item->product->name); ?>

                                            </h3>

                                            <p class="text-gray-400 mt-2">
                                                Qty : <?php echo e($item->quantity); ?>

                                            </p>

                                        </div>

                                        <div class="text-right">

                                            <p class="text-gray-400 text-sm">
                                                Subtotal
                                            </p>

                                            <h3 class="text-2xl font-bold
                                                       text-[#6b3e2e] mt-2">

                                                Rp <?php echo e(number_format($item->subtotal,0,',','.')); ?>


                                            </h3>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>

            </div>
                        <!-- RIGHT -->
            <div>

                <!-- PAYMENT -->
                <div class="bg-white rounded-[36px]
                            border border-[#eee]
                            shadow-sm p-8 sticky top-28">

                    <!-- TOP -->
                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h2 class="text-3xl font-bold text-[#2d140d]">
                                Payment
                            </h2>

                            <p class="text-gray-400 mt-2">
                                #INV-<?php echo e($order->id); ?>

                            </p>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                                    bg-[#f8f2ee]
                                    flex items-center justify-center">

                            <i class="fa-solid fa-wallet
                                      text-[#6b3e2e] text-xl"></i>

                        </div>

                    </div>

                    <!-- PAYMENT METHOD -->
                    <div class="mb-8">

                        <label class="text-sm text-gray-500 mb-4 block">
                            Payment Method
                        </label>

                        <div class="grid grid-cols-2 gap-4">

                            <!-- CASH -->
                            <label
                                class="payment-method cursor-pointer">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cash"
                                    checked
                                    class="hidden peer">

                                <div class="border border-[#eee]
                                            rounded-3xl p-5
                                            peer-checked:bg-[#2d140d]
                                            peer-checked:text-white
                                            transition">

                                    <i class="fa-solid fa-money-bill-wave
                                              text-3xl"></i>

                                    <h3 class="font-bold text-xl mt-4">
                                        Cash
                                    </h3>

                                </div>

                            </label>

                            <!-- QRIS -->
                            <label
                                class="payment-method cursor-pointer">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="qris"
                                    class="hidden peer">

                                <div class="border border-[#eee]
                                            rounded-3xl p-5
                                            peer-checked:bg-[#2d140d]
                                            peer-checked:text-white
                                            transition">

                                    <i class="fa-solid fa-qrcode
                                              text-3xl"></i>

                                    <h3 class="font-bold text-xl mt-4">
                                        QRIS
                                    </h3>

                                </div>

                            </label>

                        </div>

                    </div>

                    <!-- TOTAL -->
                    <div class="bg-[#faf7f5]
                                rounded-[32px]
                                p-6 mb-8">

                        <div class="space-y-5">

                            <!-- SUBTOTAL -->
                            <div class="flex items-center justify-between">

                                <p class="text-gray-500">
                                    Subtotal
                                </p>

                                <h3 class="font-semibold text-[#2d140d]">

                                    Rp <?php echo e(number_format($order->subtotal,0,',','.')); ?>


                                </h3>

                            </div>

                            <!-- DISCOUNT -->
                            <div class="flex items-center justify-between">

                                <p class="text-gray-500">
                                    Discount
                                </p>

                                <h3 class="font-semibold text-red-500">

                                    - Rp <?php echo e(number_format($order->discount_amount,0,',','.')); ?>


                                </h3>

                            </div>

                            <div class="border-t border-dashed"></div>

                            <!-- GRAND TOTAL -->
                            <div class="flex items-center justify-between">

                                <p class="text-2xl font-bold text-[#2d140d]">
                                    Total
                                </p>

                                <h3
                                    id="grandTotal"
                                    data-total="<?php echo e($order->total_price); ?>"
                                    class="text-4xl font-bold text-[#6b3e2e]">

                                    Rp <?php echo e(number_format($order->total_price,0,',','.')); ?>


                                </h3>

                            </div>

                        </div>

                    </div>
                    <!-- QRIS IMAGE -->
                    <div
                        id="qrisBox"
                        class="hidden mb-8">

                        <div class="bg-[#faf7f5]
                                    border border-[#eee]
                                    rounded-[32px]
                                    p-6 text-center">

                            <img
                                src="<?php echo e(asset('images/qris.png')); ?>"
                                class="w-72 mx-auto rounded-3xl shadow-sm">

                            <h3 class="text-2xl font-bold text-[#2d140d] mt-6">
                                Scan QRIS
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Silakan scan QR untuk melakukan pembayaran.
                            </p>

                        </div>

                    </div>

                    <!-- AMOUNT -->
                    <div class="mb-6">

                        <label class="text-sm text-gray-500 mb-3 block">
                            Jumlah Bayar
                        </label>

                        <input
                            type="number"
                            name="amount_paid"
                            id="amountPaid"
                            min="<?php echo e($order->total_price); ?>"
                            required
                            class="w-full bg-[#f9f7f5]
                                   border border-[#eee]
                                   rounded-2xl px-5 py-5
                                   outline-none text-2xl
                                   font-bold text-[#2d140d]">

                    </div>

                    <!-- CHANGE -->
                    <div class="mb-8">

                        <label class="text-sm text-gray-500 mb-3 block">
                            Kembalian
                        </label>

                        <div
                            id="changeAmount"
                            class="w-full bg-[#f0f7f0]
                                   border border-[#d9ead9]
                                   rounded-2xl px-5 py-5
                                   text-3xl font-bold
                                   text-green-600">

                            Rp 0

                        </div>

                    </div>

                    <!-- QUICK CASH -->
                    <div class="grid grid-cols-2 gap-4 mb-8">

                        <button
                            type="button"
                            class="quick-cash bg-[#faf7f5]
                                   hover:bg-[#f5ebe4]
                                   py-4 rounded-2xl
                                   font-semibold transition"
                            data-amount="50000">

                            Rp 50K

                        </button>

                        <button
                            type="button"
                            class="quick-cash bg-[#faf7f5]
                                   hover:bg-[#f5ebe4]
                                   py-4 rounded-2xl
                                   font-semibold transition"
                            data-amount="100000">

                            Rp 100K

                        </button>

                        <button
                            type="button"
                            class="quick-cash bg-[#faf7f5]
                                   hover:bg-[#f5ebe4]
                                   py-4 rounded-2xl
                                   font-semibold transition"
                            data-amount="200000">

                            Rp 200K

                        </button>

                        <button
                            type="button"
                            class="quick-cash bg-[#faf7f5]
                                   hover:bg-[#f5ebe4]
                                   py-4 rounded-2xl
                                   font-semibold transition"
                            data-amount="<?php echo e($order->total_price); ?>">

                            Uang Pas

                        </button>

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

                        Bayar Sekarang

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>
<!-- PAYMENT SCRIPT -->
<script>
        const paymentMethods =
        document.querySelectorAll(
            'input[name="payment_method"]'
        );

    const qrisBox =
        document.getElementById('qrisBox');

    paymentMethods.forEach(method => {

        method.addEventListener('change', () => {

            if (method.value === 'qris'
                && method.checked) {

                qrisBox.classList.remove('hidden');

            } else if (
                method.value === 'cash'
                && method.checked
            ) {

                qrisBox.classList.add('hidden');

            }

        });

    });

    const amountPaid =
        document.getElementById('amountPaid');

    const changeAmount =
        document.getElementById('changeAmount');

    const grandTotal =
        parseInt(
            document.getElementById('grandTotal')
                .dataset.total
        );

    // FORMAT RUPIAH
    function formatRupiah(number) {

        return 'Rp ' +
            Number(number)
                .toLocaleString('id-ID');

    }

    // UPDATE CHANGE
    function updateChange() {

        const paid =
            parseInt(amountPaid.value) || 0;

        const change =
            paid - grandTotal;

        if (change < 0) {

            changeAmount.innerText =
                'Uang kurang';

            changeAmount.classList.remove(
                'text-green-600',
                'bg-[#f0f7f0]',
                'border-[#d9ead9]'
            );

            changeAmount.classList.add(
                'text-red-500',
                'bg-red-50',
                'border-red-200'
            );

        } else {

            changeAmount.innerText =
                formatRupiah(change);

            changeAmount.classList.remove(
                'text-red-500',
                'bg-red-50',
                'border-red-200'
            );

            changeAmount.classList.add(
                'text-green-600',
                'bg-[#f0f7f0]',
                'border-[#d9ead9]'
            );

        }

    }

    // INPUT CHANGE
    amountPaid.addEventListener(
        'keyup',
        updateChange
    );

    amountPaid.addEventListener(
        'change',
        updateChange
    );

    // QUICK CASH
    document.querySelectorAll('.quick-cash')
        .forEach(button => {

        button.addEventListener('click', () => {

            amountPaid.value =
                button.dataset.amount;

            updateChange();

        });

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\perjalanan-kopi\resources\views/orders/payment.blade.php ENDPATH**/ ?>