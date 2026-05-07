<?php $__env->startSection('title', 'Tambah Layanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="<?php echo e(route('seller.services')); ?>" class="text-sm text-indigo-600 hover:underline"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-6 text-white">
            <h1 class="text-xl font-bold">Tambah Layanan Baru</h1>
            <p class="text-white/80 text-sm mt-1">Buat layanan print yang menarik untuk pelangganmu</p>
        </div>

        <div class="p-6">
            <?php if($errors->any()): ?>
            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="text-red-700 text-sm"><i class="fas fa-exclamation-triangle mr-1"></i><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('seller.services.store')); ?>" enctype="multipart/form-data" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        placeholder="Contoh: Print Dokumen A4 Hitam Putih">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = ['print_hitam_putih'=>'Print Hitam Putih','print_berwarna'=>'Print Berwarna','fotocopy'=>'Fotocopy','jilid'=>'Jilid','laminating'=>'Laminating','scan'=>'Scan','banner'=>'Banner','lainnya'=>'Lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($val); ?>" <?php echo e(old('category')===$val?'selected':''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" required rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 resize-none"
                        placeholder="Jelaskan detail layanan, spesifikasi, dan keunggulannya..."><?php echo e(old('description')); ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Satuan (Rp) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span>
                            <input type="number" name="price_per_unit" value="<?php echo e(old('price_per_unit')); ?>" required min="0" step="100"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                                placeholder="500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan <span class="text-red-500">*</span></label>
                        <input type="text" name="unit" value="<?php echo e(old('unit', 'lembar')); ?>" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                            placeholder="lembar / halaman / buah">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Minimum Order <span class="text-red-500">*</span></label>
                        <input type="number" name="min_order" value="<?php echo e(old('min_order', 1)); ?>" required min="1"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Estimasi Pengerjaan (hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="turnaround_days" value="<?php echo e(old('turnaround_days', 1)); ?>" required min="1"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Layanan (opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <p class="text-xs text-gray-400 mt-1">Max 2MB. Format: JPG, PNG, GIF</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-indigo-200">
                        <i class="fas fa-plus-circle mr-2"></i>Simpan Layanan
                    </button>
                    <a href="<?php echo e(route('seller.services')); ?>" class="px-6 py-3 border border-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\TA-SBD-KEL26-main\TA-SBD-KEL26-main\resources\views/seller/services/create.blade.php ENDPATH**/ ?>