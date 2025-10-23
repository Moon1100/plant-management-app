{{-- resources/views/public/farm-show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 animate-fadeIn">

        {{-- FARM HEADER CARD --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 mb-10 transition-all duration-300 hover:shadow-2xl">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-1">
                        {{ $farm->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">
                        📍 {{ $farm->location ?? 'No location specified' }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $farm->description ?? 'No description available.' }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        🌾 {{ $farm->plants->count() }} plants
                    </p>
                </div>
            </div>
        </div>

        {{-- PLANT GRID --}}
        <section
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 transition-all duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-extrabold text-gray-800 dark:text-white flex items-center gap-2">
                    🌱 Plants in this Farm
                </h2>
                @if (auth()->check() && auth()->id() === $farm->user_id)
                    <a href="{{ route('plants.create', ['farm' => $farm->id]) }}"
                        class="text-sm font-semibold text-green-600 dark:text-green-400 hover:underline">
                        + Add Plant
                    </a>
                @endif
            </div>

            @if ($farm->plants && $farm->plants->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($farm->plants as $plant)
                        <div
                            class="group flex flex-col bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            {{-- Image --}}
                            <div class="relative w-full aspect-[4/3] overflow-hidden rounded-t-2xl">
                                @if ($plant->images && count($plant->images) > 0)
                                    <img src="{{ Storage::url($plant->images[0]) }}" alt="{{ $plant->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-t-2xl">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-3xl rounded-t-2xl">
                                        🌿
                                    </div>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="flex-1 flex flex-col p-4 rounded-b-2xl">
                                <h3
                                    class="font-semibold text-lg text-gray-800 dark:text-white group-hover:text-green-500 transition-colors duration-300">
                                    {{ $plant->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $plant->plant_code }}
                                </p>
                                <a href="{{ route('public.plants.show', $plant->plant_code) }}"
                                    class="mt-auto text-sm font-medium text-green-600 dark:text-green-400 hover:underline">
                                    View →
                                </a>

                                @if (auth()->check() && auth()->id() === $plant->farm->user_id)
                                    <a href="{{ route('plants.edit', $plant) }}"
                                        class="text-sm px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-700 dark:text-gray-200 hover:bg-gray-200">Edit</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                    No plants found for this farm 🌾
                </div>
            @endif
        </section>
    </div>

    {{-- Fade animation --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }
    </style>
@endsection
