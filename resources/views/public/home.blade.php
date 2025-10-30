{{-- resources/views/public/home.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 animate-fadeIn">

    {{-- GRID CONTAINER --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- LEFT SECTION --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- 🌿 Recent Plants --}}
            <section
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-800 hover:shadow-2xl transition-all duration-300">
                <h2
                    class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 pb-2">
                    🌱 Recent Plants
                </h2>

                {{-- CARD GRID --}}
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 place-items-stretch">
                    @forelse($recentPlants as $plant)
                        @include('components.plant-card', ['plant' => $plant])
                    @empty
                        <div
                            class="col-span-full text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                            No recent plants yet 🌿
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- 🏡 Recent Farms --}}
            <section
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-800 hover:shadow-2xl transition-all duration-300">
                <h2
                    class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 pb-2">
                    🏡 Recent Farms
                </h2>

                {{-- CARD GRID --}}
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 place-items-stretch">
                    @forelse($recentFarms as $farm)
                        @include('components.farm-card', ['farm' => $farm])
                    @empty
                        <div
                            class="col-span-full text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                            No recent farms yet 🌾
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- RIGHT SIDEBAR (Now styled as grid cards) --}}
        <aside class="space-y-8">
            {{-- About --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-800 flex flex-col justify-between hover:shadow-2xl transition-all duration-300">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                        🌼 About PlantTracker
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">
                        Track your plants’ growth, share your farm, and connect with other growers.
                    </p>
                </div>
            </div>

            {{-- Explore --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-800 flex flex-col justify-between hover:shadow-2xl transition-all duration-300">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                        🔍 Explore Farms
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">
                        Discover more public farms and connect with growers around you.
                    </p>
                </div>
                <a href="{{ Route::has('public.farms') ? route('public.farms') : url('/farms') }}"
                   class="text-green-600 dark:text-green-400 hover:underline text-sm mt-4 inline-block font-medium">
                    View all farms →
                </a>
            </div>
                 <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-800 flex flex-col justify-between hover:shadow-2xl transition-all duration-300">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                       ☁️🌱 Cloud Farms <span class="font-bold">Comming Soon</span>
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">
                        Start your own cloud farms or grow your own crops digitally.
                    </p>
                </div>
                <a href="{{ Route::has('public.blogs.show') ? route('public.blogs.show', ['slug' => 'cloud_farm']) : url('/blogs/cloud_farm') }}"
                    class="text-green-600 dark:text-green-400 hover:underline text-sm mt-4 inline-block font-medium">
                     Explore the idea →
                </a>
            </div>
        </aside>
    </div>
</div>

{{-- Fade animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.6s ease-in-out;
}
</style>
@endsection
