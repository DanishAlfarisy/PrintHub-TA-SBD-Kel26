@extends('layouts.auth')
@section('title', 'Daftar Akun')

@section('content')
<div>
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
    <p class="text-gray-500 mb-6">Bergabung dengan PrintHub sekarang</p>

    @if($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl">
        <ul class="space-y-1">
            @foreach($errors->all() as $error)
            <li class="text-red-700 text-sm"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Role Selection -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Saya mendaftar sebagai</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="role-card border-2 rounded-xl p-4 {{ old('role', 'buyer') === 'buyer' ? 'selected border-indigo-500' : 'border-gray-200' }}" id="card-buyer">
                    <input type="radio" name="role" value="buyer" class="hidden" {{ old('role', 'buyer') === 'buyer' ? 'checked' : '' }}>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                        </div>
                        <p class="font-semibold text-gray-800 text-sm">Pembeli</p>
                        <p class="text-gray-400 text-xs mt-1">Pesan jasa print</p>
                    </div>
                </label>
                <label class="role-card border-2 rounded-xl p-4 {{ old('role') === 'seller' ? 'selected border-indigo-500' : 'border-gray-200' }}" id="card-seller">
                    <input type="radio" name="role" value="seller" class="hidden" {{ old('role') === 'seller' ? 'checked' : '' }}>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-store text-purple-600 text-xl"></i>
                        </div>
                        <p class="font-semibold text-gray-800 text-sm">Penjual</p>
                        <p class="text-gray-400 text-xs mt-1">Buka toko print</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                        placeholder="Nama kamu">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-phone"></i></span>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                        placeholder="08xxxxxxxxxx">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                    placeholder="email@kamu.com">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap</label>
            <div class="relative">
                <span class="absolute left-3 top-3 text-gray-20 text-sm"><i class="fas fa-map-marker-alt"></i></span>
                <textarea name="address" required rows="2"
                    class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white resize-none"
                    placeholder="Jalan, Kota, Provinsi">{{ old('address') }}</textarea>
            </div>
             <button
            type="button"
            id="openMapModal"
            class="btn-primary w-auto py-2 px-4 text-white font-semibold rounded-xl text-sm mt-2">
            <i class="fas fa-map-marked-alt"></i>
            <span>Pilih Lokasi</span>

        </button>
        </div>

        <!-- Seller-only fields -->
        <div id="seller-fields" class="{{ old('role') === 'seller' ? '' : 'hidden' }}">
            <div class="p-4 bg-purple-50 border border-purple-100 rounded-xl space-y-3">
                <p class="text-sm font-semibold text-gray-700"><i class="fas fa-store mr-1"></i>Informasi Toko</p>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Toko</label>
                    <input type="text" name="store_name" value="{{ old('store_name') }}"
                        class="input-focus w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                        placeholder="Nama toko kamu">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Toko</label>
                    <textarea name="store_description" rows="2"
                        class="input-focus w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white resize-none"
                        placeholder="Ceritakan toko kamu...">{{ old('store_description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" required
                        class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                        placeholder="Min 8 karakter">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password_confirmation" required
                        class="input-focus w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-white"
                        placeholder="Ulangi password">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full py-3 px-6 text-white font-semibold rounded-xl text-sm mt-2">
            <i class="fas fa-user-plus mr-2"></i>Buat Akun Sekarang
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-gray-500 text-sm">Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>

<!-- Modal Google Maps -->
<div id="mapModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-11/12 max-w-4xl">

        <!-- Header -->
        <div class="flex justify-between items-center p-5 border-b">

            <h2 class="text-xl font-bold">
                Pilih Lokasi 
            </h2>
            <button id="closeMapModal"
                    class="text-gray-500 hover:text-red-500 text-xl">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <!-- Isi -->
        <div class="p-5">

            <div id="map"
                class="h-[450px] rounded-xl bg-gray-100 flex items-center justify-center">

                <span class="text-gray-500">
                    Google Maps 
                </span>

            </div>
        </div>
        <!-- Footer -->
        <div class="p-5 border-t flex justify-end">
            <button
                class="btn-primary px-6 py-2 text-white rounded-xl">
                Gunakan Lokasi
            </button>
        </div>
    </div>
</div>
<script>
    const roleInputs = document.querySelectorAll('input[name="role"]');
    const cardBuyer = document.getElementById('card-buyer');
    const cardSeller = document.getElementById('card-seller');
    const sellerFields = document.getElementById('seller-fields');

    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            document.querySelectorAll('.role-card').forEach(c => {
                c.classList.remove('selected', 'border-indigo-500');
                c.classList.add('border-gray-200');
            });
            this.classList.add('selected', 'border-indigo-500');
            this.classList.remove('border-gray-200');
            sellerFields.classList.toggle('hidden', radio.value !== 'seller');
        });
    });

const mapModal = document.getElementById("mapModal");
const openMap = document.getElementById("openMapModal");
const closeMap = document.getElementById("closeMapModal");

openMap.addEventListener("click", function () {

    mapModal.classList.remove("hidden");
    mapModal.classList.add("flex");

});

closeMap.addEventListener("click", function () {

    mapModal.classList.add("hidden");
    mapModal.classList.remove("flex");

});

mapModal.addEventListener("click", function(e){

    if(e.target === mapModal){

        mapModal.classList.add("hidden");
        mapModal.classList.remove("flex");

    }

});
</script>
@endsection
