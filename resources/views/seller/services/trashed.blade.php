@extends('layouts.app')
@section('title', 'Layanan Terhapus')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Layanan Terhapus</h1>
            <p class="text-gray-500 mt-1">Layanan yang sudah dihapus dapat dipulihkan</p>
        </div>
        <a href="{{ route('seller.services') }}" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
            <i class="fas fa-arrow-left mr-1"></i>Kembali
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" action="{{ route('seller.services.trashed') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-search"></i></span>
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari layanan..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700">Cari</button>
            @if($search)
            <a href="{{ route('seller.services.trashed') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-200">Reset</a>
            @endif
        </form>
    </div>

    @if($services->isEmpty())
    <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-gray-100">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check-circle text-green-400 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-gray-600 mb-2">Tidak ada layanan yang dihapus</h3>
        <p class="text-gray-400 text-sm">Semua layanan masih aktif</p>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Layanan</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dihapus Pada</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($services as $service)
                    <tr class="hover:bg-gray-50 transition-all bg-red-50/30">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-print text-gray-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-600 text-sm">{{ $service->name }}</p>
                                    <p class="text-gray-400 text-xs line-clamp-1">{{ Str::limit($service->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 bg-gray-200 text-gray-600 rounded-lg text-xs font-medium">{{ $service->category_label }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <p class="font-semibold text-gray-600 text-sm">Rp {{ number_format($service->price_per_unit, 0, ',', '.') }}</p>
                            <p class="text-gray-400 text-xs">/ {{ $service->unit }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm text-gray-500">{{ $service->deleted_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2">
                                <form method="POST" action="{{ route('seller.services.restore', $service->id) }}">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-green-600 text-white rounded-lg text-xs font-semibold hover:bg-green-700 transition-all">
                                        <i class="fas fa-undo mr-1"></i>Pulihkan
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $services->withQueryString()->links() }}</div>
    @endif
</div>
@endsection