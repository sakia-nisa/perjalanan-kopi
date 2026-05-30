<?php $__env->startSection('content'); ?>

<!-- HEADER -->
<div class="flex items-center justify-between mb-10">

    <div>

        <h1 class="text-5xl font-bold text-[#2d140d]">
            Manajemen Menu dan Stok
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Kelola daftar menu, harga, dan stok secara mudah.
        </p>

    </div>

    <!-- BUTTON -->
    <a href="/products/create"
       class="bg-gradient-to-r
              from-[#2d140d]
              to-[#6b3e2e]
              hover:opacity-90
              text-white px-7 py-4
              rounded-2xl font-semibold
              flex items-center gap-3 transition">

        <i class="fa-solid fa-plus"></i>

        Tambah Menu

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
                placeholder="Cari nama menu..."
                class="w-full bg-white border border-[#eee]
                       rounded-2xl px-5 py-4 pl-14 outline-none
                       focus:ring-2 focus:ring-[#6b3e2e]/20">

            <i class="fa-solid fa-magnifying-glass
                      absolute left-5 top-1/2
                      -translate-y-1/2 text-gray-400"></i>

        </div>

        <!-- CATEGORY -->
        <select
            id="categoryFilter"
            class="bg-white border border-[#eee]
                   rounded-2xl px-5 py-4 outline-none">

            <option value="">Semua Kategori</option>
            <option value="kopi">Kopi</option>
            <option value="non_kopi">Non Kopi</option>

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
                        Gambar
                    </th>

                    <th class="text-left px-6 py-5">
                        Nama Menu
                    </th>

                    <th class="text-left px-6 py-5">
                        Kategori
                    </th>

                    <th class="text-left px-6 py-5">
                        Harga Jual
                    </th>

                    <th class="text-left px-6 py-5">
                        HPP
                    </th>

                    <th class="text-left px-6 py-5">
                        Stok
                    </th>

                    <th class="text-left px-6 py-5">
                        Status
                    </th>

                    <th class="text-left px-6 py-5 rounded-r-2xl">
                        Aksi
                    </th>

                </tr>

            </thead>

            <!-- BODY -->
            <tbody id="tableBody">

                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr class="border-b border-[#f2f2f2]
                               hover:bg-[#fcfaf8]
                               transition product-row">

                        <!-- NO -->
                        <td class="px-6 py-5">
                            <?php echo e($loop->iteration); ?>

                        </td>

                        <!-- IMAGE -->
                        <td class="px-6 py-5">

                            <img
                                src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                class="w-20 h-20 rounded-2xl object-cover">

                        </td>

                        <!-- NAME -->
                        <td class="px-6 py-5">

                            <h3 class="font-semibold text-lg text-[#2d140d]">
                                <?php echo e($product->name); ?>

                            </h3>

                        </td>

                        <!-- CATEGORY -->
                        <td class="px-6 py-5 category-name">

                            <span class="capitalize">
                                <?php echo e(str_replace('_', ' ', $product->category)); ?>

                            </span>

                        </td>

                        <!-- PRICE -->
                        <td class="px-6 py-5 font-medium">

                            Rp <?php echo e(number_format($product->selling_price,0,',','.')); ?>


                        </td>

                        <!-- HPP -->
                        <td class="px-6 py-5 text-gray-600">

                            Rp <?php echo e(number_format($product->hpp,0,',','.')); ?>


                        </td>

                        <!-- STOCK -->
                        <td class="px-6 py-5 font-semibold">

                            <?php echo e($product->stock); ?>


                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            <span class="bg-[#edf7e7]
                                         text-[#5f9c47]
                                         px-4 py-2
                                         rounded-xl text-sm font-medium">

                                <?php echo e($product->status); ?>


                            </span>

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <!-- EDIT -->
                                <a href="/products/<?php echo e($product->id); ?>/edit"
                                   class="border border-[#d8c7bb]
                                          hover:bg-[#f5ebe4]
                                          text-[#6b3e2e]
                                          px-5 py-3 rounded-2xl
                                          flex items-center gap-2 transition">

                                    <i class="fa-solid fa-pen"></i>

                                    Edit

                                </a>
                                <!-- DELETE -->
                                <form action="/products/<?php echo e($product->id); ?>" method="POST" style="display:inline;" class="confirm-form" data-title="Hapus Menu" data-message="Yakin hapus menu ini? Data menu akan hilang dari sistem.">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="border border-[#efc7c7] hover:bg-red-50 text-red-500 px-5 py-3 rounded-2xl flex items-center gap-2 transition">Hapus</button>
                                </form>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    </div>

</div>

<!-- PAGINATION -->
<div class="mt-10 flex flex-col items-center gap-4">

    <?php echo e($products->links('pagination::tailwind')); ?>


    <p class="text-gray-500">
        Showing <?php echo e($products->firstItem()); ?>

        to <?php echo e($products->lastItem()); ?>

        of <?php echo e($products->total()); ?> results
    </p>

</div>

<!-- SEARCH SCRIPT -->
<script>

    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');

    function filterTable() {

        const keyword = searchInput.value.toLowerCase();
        const category = categoryFilter.value.toLowerCase();

        const rows = document.querySelectorAll('.product-row');

        rows.forEach(row => {

            const text = row.innerText.toLowerCase();

            const rowCategory =
                row.querySelector('.category-name')
                   .innerText
                   .toLowerCase();

            const matchKeyword = text.includes(keyword);

            const matchCategory =
                category === '' || rowCategory.includes(category);

            if (matchKeyword && matchCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    }

    searchInput.addEventListener('keyup', filterTable);
    categoryFilter.addEventListener('change', filterTable);

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\perjalanan-kopi\resources\views/products/index.blade.php ENDPATH**/ ?>