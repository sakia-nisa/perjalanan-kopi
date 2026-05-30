<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-10">

        <h1 class="text-5xl font-bold text-[#2d140d]">
            Edit Menu
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Perbarui informasi menu dan stok produk.
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[36px]
                border border-[#eee]
                shadow-sm overflow-hidden">

        <form
            action="/products/<?php echo e($product->id); ?>"
            method="POST"
            enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 xl:grid-cols-2">

                <!-- LEFT -->
                <div class="p-10 border-r border-[#f2f2f2]">

                    <!-- IMAGE PREVIEW -->
                    <div class="mb-8">

                        <label class="block text-lg font-semibold
                                      text-[#2d140d] mb-4">

                            Gambar Menu

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
                                    src="<?php echo e(asset('storage/' . $product->image)); ?>"
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
                            value="<?php echo e($product->name); ?>"
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

                            <option value="kopi"
                                <?php echo e($product->category == 'kopi' ? 'selected' : ''); ?>>
                                Kopi
                            </option>

                            <option value="non_kopi"
                                <?php echo e($product->category == 'non_kopi' ? 'selected' : ''); ?>>
                                Non Kopi
                            </option>

                            <option value="snack"
                                <?php echo e($product->category == 'snack' ? 'selected' : ''); ?>>
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
                                value="<?php echo e($product->selling_price); ?>"
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
                                value="<?php echo e($product->hpp); ?>"
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
                            value="<?php echo e($product->stock); ?>"
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

                            <option value="available"
                                <?php echo e($product->status == 'available' ? 'selected' : ''); ?>>
                                Available
                            </option>

                            <option value="unavailable"
                                <?php echo e($product->status == 'unavailable' ? 'selected' : ''); ?>>
                                Unavailable
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex items-center gap-4">

                        <!-- UPDATE -->
                        <button
                            type="submit"
                            class="flex-1 bg-gradient-to-r
                                   from-[#2d140d]
                                   to-[#6b3e2e]
                                   hover:opacity-90
                                   text-white py-5 rounded-2xl
                                   text-lg font-semibold transition">

                            Update Menu

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\perjalanan-kopi\resources\views/products/edit.blade.php ENDPATH**/ ?>