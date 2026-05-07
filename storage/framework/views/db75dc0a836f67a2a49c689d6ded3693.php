<?php $__env->startSection('title', 'Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
    <p class="text-gray-500 mb-8">Masuk ke akun PrintHub kamu</p>

    <?php if($errors->any()): ?>
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl">
        <p class="text-red-700 text-sm font-medium"><i class="fas fa-exclamation-triangle mr-2"></i><?php echo e($errors->first()); ?></p>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm bg-white transition-all <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="email@kamu.com">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="input-focus w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl text-sm bg-white transition-all"
                    placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i id="eye-icon" class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-indigo-600">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="btn-primary w-full py-3 px-6 text-white font-semibold rounded-xl text-sm">
            <i class="fas fa-sign-in-alt mr-2"></i>Masuk Sekarang
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-gray-500 text-sm">Belum punya akun?
            <a href="<?php echo e(route('register')); ?>" class="text-indigo-600 font-semibold hover:underline">Daftar di sini</a>
        </p>
    </div>

    <!-- Demo accounts -->
    <div class="mt-6 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
        <p class="text-xs font-semibold text-indigo-700 mb-2"><i class="fas fa-info-circle mr-1"></i>Akun Demo</p>
        <div class="space-y-1">
            <p class="text-xs text-indigo-600">Pembeli: buyer@demo.com / password</p>
            <p class="text-xs text-indigo-600">Penjual: seller@demo.com / password</p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pwd.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\TA-SBD-KEL26-main\TA-SBD-KEL26-main\resources\views/auth/login.blade.php ENDPATH**/ ?>