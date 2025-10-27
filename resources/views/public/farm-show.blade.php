{{-- resources/views/public/farm-show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 animate-fadeIn">

    {{-- FARM HEADER --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-8 mb-10 transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6">
            <div class="flex-1">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    {{ $farm->name }}
                </h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    {{ $farm->location ?? 'No location specified' }}
                </p>
                @if($farm->description)
                    <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        {{ $farm->description }}
                    </p>
                @endif
            </div>

            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $farm->plants->count() }} plants
                </p>
            </div>
        </div>

        {{-- Owner Actions --}}
        @if(auth()->check() && auth()->id() === $farm->user_id)
            <div class="flex flex-wrap items-center gap-2 mt-6">
                <a href="{{ route('farms.edit', $farm) }}"
                   class="px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                   Edit
                </a>

               <form method="POST" action="{{ route('farms.toggle-public', $farm) }}" class="inline-block ml-3">
                @csrf
                @method('PATCH') <button type="submit"
                        class="px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-700 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        {{ $farm->is_public ? 'Make Private' : 'Make Public' }}
                    </button>
            </form>

                <a href="{{ route('plants.create', ['farm' => $farm->id]) }}"
                   class="px-3 py-1.5 text-sm border border-green-500 text-green-600 dark:text-green-400 rounded-md hover:bg-green-50 dark:hover:bg-green-900/30 transition">
                   Add Plant
                </a>
            </div>
        @endif
    </div>

    {{-- PLANT GRID --}}
    <section class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 transition-all duration-300">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
            Plants in this Farm
        </h2>

        @if($farm->plants && $farm->plants->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($farm->plants as $plant)
                    <div class="group flex flex-col bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-green-500 transition-all duration-200">
                        {{-- Image --}}
                        <div class="relative w-full aspect-[4/3] overflow-hidden">
                            @if($plant->images && count($plant->images) > 0)
                                <img src="{{ Storage::url($plant->images[0]) }}" alt="{{ $plant->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-3xl">
                                    🌿
                                </div>
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 flex flex-col p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white">
                                {{ $plant->name }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                {{ $plant->plant_code }}
                            </p>

                            <div class="flex justify-between items-center mt-auto">
                                <a href="{{ route('public.plants.show', $plant->plant_code) }}"
                                   class="text-sm text-green-600 dark:text-green-400 hover:underline">
                                   View
                                </a>

                                @if(auth()->check() && auth()->id() === $plant->farm->user_id)
                                    <a href="{{ route('plants.edit', $plant) }}"
                                       class="text-xs px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                       Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                No plants found in this farm.
            </div>
        @endif
    </section>
</div>

{{-- Fade animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.5s ease-in-out;
}
</style>
@endsection
