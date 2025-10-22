{{-- filepath: /Users/bayam/Documents/web/plant-management/plant-managemet/resources/views/public/home.blade.php --}}
<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Jejaki Perkembangan <br>
                    <span class="text-green-200">Pokok Anda</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-green-100 max-w-3xl mx-auto">
                    Platform digital untuk memantau, merekod dan berkongsi perjalanan pertumbuhan setiap pokok di ladang anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('farms.create') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                            Cipta Ladang Pertama
                        </a>
                        <a href="{{ Route::has('farms.index') ? route('farms.index') : url('/farms') }}" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-colors">
                            Lihat Ladang Saya
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                            Daftar Sekarang
                        </a>
                        <a href="{{ Route::has('public.farms') ? route('public.farms') : url('/farms') }}" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-colors">
                            Terokai Ladang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Farms Section -->
    @if($recentFarms->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ladang Terkini</h2>
                <p class="text-lg text-gray-600">Terokai ladang-ladang yang baru didaftarkan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentFarms as $farm)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $farm->name }}</h3>
                            <p class="text-gray-600 mb-2">📍 {{ $farm->location }}</p>
                            <p class="text-gray-500 text-sm mb-4">{{ Str::limit($farm->description, 100) }}</p>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $farm->plants_count }} pokok</span>
                                <a href="{{ route('public.farms.show', $farm->slug) }}" class="text-green-600 hover:text-green-700 font-medium">
                                    Lihat Ladang →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Recent Plants Section -->
    @if($recentPlants->count() > 0)
        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Lihat Perkembangan Pokok Terkini</h2>
                    <p class="text-lg text-gray-600">Pokok-pokok yang baru ditambah ke platform</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($recentPlants as $plant)
                        @include('components.plant-card', ['plant' => $plant])
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Pilih PlantTracker?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📱</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Mudah Digunakan</h3>
                <p class="text-gray-600">Interface yang simple dan intuitif untuk semua pengguna</p>
            </div>

            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📊</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Jejak Perkembangan</h3>
                <p class="text-gray-600">Rekod setiap perubahan dan milestone pertumbuhan pokok</p>
            </div>

            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🔗</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kongsi Dengan Mudah</h3>
                <p class="text-gray-600">QR code untuk setiap pokok memudahkan perkongsian maklumat</p>
            </div>
        </div>
    </div>
</x-app-layout><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
