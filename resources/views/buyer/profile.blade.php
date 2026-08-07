@extends('layouts.app')
@section('title', 'Profil Saya')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
         <a href="#"
        class="inline-flex items-center justify-center mr-20 px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-all">
                <i class="fas fa-edit mr-2"></i>
        Edit Profil
        </a>
    </div>
        <div class="divide-y divide-gray-100">

            <!-- Nama -->
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/3">
                    <p class="text-sm text-gray-400">
                        Nama Lengkap
                    </p>
                </div>

                <div class="w-full sm:w-2/3 mt-1 sm:mt-0">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </p>
                </div>

            </div>


            <!-- Email -->
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/3">
                    <p class="text-sm text-gray-400">
                        Email
                    </p>
                </div>

                <div class="w-full sm:w-2/3 mt-1 sm:mt-0">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>


            <!-- Telepon -->
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/3">
                    <p class="text-sm text-gray-400">
                        Nomor Telepon
                    </p>
                </div>

                <div class="w-full sm:w-2/3 mt-1 sm:mt-0">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->phone ?? '-' }}
                    </p>
                </div>

            </div>


            <!-- Alamat -->
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/3">
                    <p class="text-sm text-gray-400">
                        Alamat
                    </p>
                </div>

                <div class="w-full sm:w-2/3 mt-1 sm:mt-0">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->address ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection