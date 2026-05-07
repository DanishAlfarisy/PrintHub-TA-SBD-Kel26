<?php $__env->startSection('title', 'Laporan Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Pesanan</h1>
            <p class="text-gray-500 mt-1">Data lengkap dengan JOIN tabel orders, order_items, services, users</p>
        </div>
        <a href="<?php echo e(route('seller.orders')); ?>" class="text-sm text-indigo-600 hover:underline"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
    </div>

    

    <?php if($orders->isEmpty()): ?>
    <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-gray-100">
        <i class="fas fa-chart-bar text-gray-400 text-4xl mb-4"></i>
        <p class="text-gray-400">Belum ada data pesanan</p>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold">Kode Order</th>
                        <th class="text-left py-3 px-4 font-semibold">Pembeli</th>
                        <th class="text-left py-3 px-4 font-semibold">Layanan</th>
                        <th class="text-left py-3 px-4 font-semibold">Kategori</th>
                        <th class="text-left py-3 px-4 font-semibold">Qty</th>
                        <th class="text-left py-3 px-4 font-semibold">Harga Satuan</th>
                        <th class="text-left py-3 px-4 font-semibold">Total</th>
                        <th class="text-left py-3 px-4 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="py-3 px-4 font-mono text-xs font-bold text-indigo-700"><?php echo e($order->order_code); ?></td>
                        <td class="py-3 px-4"><?php echo e($order->buyer_name); ?></td>
                        <td class="py-3 px-4"><?php echo e($order->service_name); ?></td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded text-xs"><?php echo e(str_replace('_',' ',ucwords($order->category,'_'))); ?></span>
                        </td>
                        <td class="py-3 px-4 font-semibold"><?php echo e($order->quantity); ?></td>
                        <td class="py-3 px-4">Rp <?php echo e(number_format($order->unit_price, 0, ',', '.')); ?></td>
                        <td class="py-3 px-4 font-bold text-gray-800">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-xs font-semibold
                                <?php if($order->status==='completed'): ?> bg-green-100 text-green-700
                                <?php elseif($order->status==='pending'): ?> bg-yellow-100 text-yellow-700
                                <?php elseif($order->status==='processing'): ?> bg-purple-100 text-purple-700
                                <?php elseif($order->status==='cancelled'): ?> bg-red-100 text-red-700
                                <?php else: ?> bg-blue-100 text-blue-700 <?php endif; ?>">
                                <?php echo e($order->status); ?>

                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-400 text-xs"><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 flex justify-between items-center bg-gray-50">
            <p class="text-sm text-gray-500">Total <strong><?php echo e(count($orders)); ?></strong> transaksi</p>
            <p class="text-sm font-bold text-gray-800">Grand Total: Rp <?php echo e(number_format(collect($orders)->sum('total_price'), 0, ',', '.')); ?></p>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\TA-SBD-KEL26-main\TA-SBD-KEL26-main\resources\views/seller/orders/report.blade.php ENDPATH**/ ?>