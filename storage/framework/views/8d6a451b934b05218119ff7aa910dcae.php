<?php $__env->startSection('title', 'Jelajahi Layanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jelajahi Layanan</h1>
        <p class="text-gray-500 mt-1">Temukan jasa print & fotocopy terbaik</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" action="<?php echo e(route('buyer.services')); ?>" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-search"></i></span>
                <input type="text" name="q" value="<?php echo e($query); ?>" placeholder="Cari layanan, misal: print A4, fotocopy..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
            </div>
            <select name="category" class="px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 bg-white">
                <option value="">Semua Kategori</option>
                <option value="print_hitam_putih" <?php echo e($category === 'print_hitam_putih' ? 'selected' : ''); ?>>Print Hitam Putih</option>
                <option value="print_berwarna" <?php echo e($category === 'print_berwarna' ? 'selected' : ''); ?>>Print Berwarna</option>
                <option value="fotocopy" <?php echo e($category === 'fotocopy' ? 'selected' : ''); ?>>Fotocopy</option>
                <option value="jilid" <?php echo e($category === 'jilid' ? 'selected' : ''); ?>>Jilid</option>
                <option value="laminating" <?php echo e($category === 'laminating' ? 'selected' : ''); ?>>Laminating</option>
                <option value="scan" <?php echo e($category === 'scan' ? 'selected' : ''); ?>>Scan</option>
                <option value="banner" <?php echo e($category === 'banner' ? 'selected' : ''); ?>>Banner</option>
                <option value="lainnya" <?php echo e($category === 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-all">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
            <?php if($query || $category): ?>
            <a href="<?php echo e(route('buyer.services')); ?>" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-all">
                <i class="fas fa-times mr-1"></i>Reset
            </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Results info -->
    <?php if($query || $category): ?>
    <p class="text-sm text-gray-500 mb-4">
        Menampilkan <strong><?php echo e($services->total()); ?></strong> hasil
        <?php if($query): ?> untuk "<strong><?php echo e($query); ?></strong>" <?php endif; ?>
        <?php if($category): ?> di kategori <strong><?php echo e($category); ?></strong> <?php endif; ?>
    </p>
    <?php endif; ?>

    <!-- Services Grid -->
    <?php if($services->isEmpty()): ?>
    <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-gray-100">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-gray-400 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-gray-600 mb-2">Layanan tidak ditemukan</h3>
        <p class="text-gray-400 text-sm">Coba kata kunci yang berbeda</p>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1">
            <!-- Image / Category Banner -->
            <div class="h-40 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center relative overflow-hidden">
                <?php if($service->image): ?>
                <img src="<?php echo e(asset('storage/' . $service->image)); ?>" alt="<?php echo e($service->name); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                <div class="text-center text-white">
                    <i class="fas fa-print text-5xl mb-2 opacity-80"></i>
                </div>
                <?php endif; ?>
                <div class="absolute top-3 left-3">
                    <span class="px-2 py-1 bg-white/90 rounded-lg text-xs font-semibold text-indigo-700"><?php echo e($service->category_label); ?></span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-800 mb-1 line-clamp-1"><?php echo e($service->name); ?></h3>
                <p class="text-gray-400 text-xs mb-3 line-clamp-2"><?php echo e($service->description); ?></p>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-store text-indigo-600 text-xs"></i>
                    </div>
                    <span class="text-xs text-gray-500 truncate"><?php echo e($service->seller->store_name ?? $service->seller->name); ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <p class="text-lg font-bold text-indigo-600">Rp <?php echo e(number_format($service->price_per_unit, 0, ',', '.')); ?></p>
                        <p class="text-xs text-gray-400">/ <?php echo e($service->unit); ?></p>
                    </div>
                    <a href="<?php echo e(route('buyer.services.show', $service)); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-all">
                        Pesan
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="mt-6"><?php echo e($services->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\TA-SBD-KEL26-main\TA-SBD-KEL26-main\resources\views/buyer/services/index.blade.php ENDPATH**/ ?>