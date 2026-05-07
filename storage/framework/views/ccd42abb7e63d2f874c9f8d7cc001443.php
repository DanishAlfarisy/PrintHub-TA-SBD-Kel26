<?php $__env->startSection('title', 'Dashboard Pembeli'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Welcome -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Halo, <?php echo e(auth()->user()->name); ?>! 👋</h1>
        <p class="text-gray-500 mt-1">Selamat datang kembali di PrintHub</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800"><?php echo e($totalOrders); ?></p>
                <p class="text-gray-500 text-sm">Total Pesanan</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800"><?php echo e($pendingOrders); ?></p>
                <p class="text-gray-500 text-sm">Menunggu Proses</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800"><?php echo e($completedOrders); ?></p>
                <p class="text-gray-500 text-sm">Selesai</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <a href="<?php echo e(route('buyer.services')); ?>" class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <i class="fas fa-store text-3xl mb-3 group-hover:scale-110 transition-transform inline-block"></i>
                    <h3 class="text-xl font-bold mb-1">Jelajahi Layanan</h3>
                    <p class="text-white/80 text-sm">Temukan jasa print terbaik untukmu</p>
                </div>
                <i class="fas fa-arrow-right text-2xl text-white/60"></i>
            </div>
        </a>
        <a href="<?php echo e(route('buyer.orders')); ?>" class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <i class="fas fa-clipboard-list text-3xl mb-3 group-hover:scale-110 transition-transform inline-block"></i>
                    <h3 class="text-xl font-bold mb-1">Pesanan Saya</h3>
                    <p class="text-white/80 text-sm">Pantau status semua pesananmu</p>
                </div>
                <i class="fas fa-arrow-right text-2xl text-white/60"></i>
            </div>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800">Pesanan Terbaru</h2>
            <a href="<?php echo e(route('buyer.orders')); ?>" class="text-sm text-indigo-600 font-medium hover:underline">Lihat semua</a>
        </div>
        <?php if($recentOrders->isEmpty()): ?>
        <div class="p-12 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-box-open text-gray-400 text-3xl"></i>
            </div>
            <h3 class="font-semibold text-gray-600 mb-2">Belum ada pesanan</h3>
            <p class="text-gray-400 text-sm mb-4">Yuk buat pesanan pertamamu!</p>
            <a href="<?php echo e(route('buyer.services')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all">
                <i class="fas fa-store"></i> Jelajahi Layanan
            </a>
        </div>
        <?php else: ?>
        <div class="divide-y divide-gray-50">
            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-all">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-print text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm"><?php echo e($order->order_code); ?></p>
                        <p class="text-gray-400 text-xs"><?php echo e($order->seller->store_name ?? $order->seller->name); ?> • <?php echo e($order->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        <?php if($order->status === 'completed'): ?> bg-green-100 text-green-700
                        <?php elseif($order->status === 'pending'): ?> bg-yellow-100 text-yellow-700
                        <?php elseif($order->status === 'processing'): ?> bg-purple-100 text-purple-700
                        <?php elseif($order->status === 'cancelled'): ?> bg-red-100 text-red-700
                        <?php else: ?> bg-blue-100 text-blue-700 <?php endif; ?>">
                        <?php echo e($order->status_label); ?>

                    </span>
                    <p class="text-sm font-bold text-gray-800">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></p>
                    <a href="<?php echo e(route('buyer.orders.show', $order)); ?>" class="text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\TA-SBD-KEL26-main\TA-SBD-KEL26-main\resources\views/buyer/dashboard.blade.php ENDPATH**/ ?>