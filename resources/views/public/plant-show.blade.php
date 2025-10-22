{{-- resources/views/public/plant-show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 animate-fadeIn">

    {{-- PLANT HEADER CARD --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 mb-10 transition-all duration-300 hover:shadow-2xl">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Image --}}
            <div class="w-full md:w-60 aspect-square bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden flex items-center justify-center shadow-inner">
                @if($plant->images && count($plant->images) > 0)
                    <img src="{{ Storage::url($plant->images[0]) }}"
                         alt="{{ $plant->name }}"
                         class="w-full h-full object-cover rounded-2xl">
                @else
                    <span class="text-5xl">🌱</span>
                @endif
            </div>

            {{-- Details --}}
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $plant->name }}
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Code: <span class="font-medium text-gray-800 dark:text-gray-200">{{ $plant->plant_code }}</span>
                    </p>

                    <div class="mt-4 text-gray-700 dark:text-gray-300 space-y-2 text-sm leading-relaxed">
                        @if($plant->description)
                            <p>{{ $plant->description }}</p>
                        @endif
                        <p>
                            Farm:
                            <a href="{{ route('public.farms.show', $plant->farm->slug) }}"
                               class="text-green-600 dark:text-green-400 hover:underline">
                                {{ $plant->farm->name }}
                            </a>
                        </p>
                        @if($plant->planted_at)
                            <p>Planted: {{ $plant->planted_at->format('M d, Y') }}</p>
                        @endif
                        @if($plant->insertion_date)
                            <p>Inserted: {{ $plant->insertion_date->format('M d, Y') }}</p>
                        @endif
                        @if($plant->batch)
                            <p>Batch: {{ $plant->batch }}</p>
                        @endif
                    </div>
                </div>

                {{-- QR Code --}}
                @if($plant->qr_code_path && Storage::exists($plant->qr_code_path))
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center gap-3">
                        <img src="{{ Storage::url($plant->qr_code_path) }}" alt="QR for {{ $plant->name }}"
                             class="w-24 h-24 rounded-xl border border-gray-200 dark:border-gray-700 shadow">
                        <a href="{{ Storage::url($plant->qr_code_path) }}" download
                           class="text-sm text-green-600 dark:text-green-400 hover:underline font-medium">
                            ⬇️ Download QR Code
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- UPDATES SECTION --}}
    <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 transition-all duration-300 hover:shadow-2xl">
        <h2 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 pb-2">
            🪴 Plant Updates
        </h2>

        @if($plant->updates && $plant->updates->count())
            <div class="space-y-4">
                @foreach($plant->updates as $update)
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-4 hover:shadow-md transition-all duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <p class="font-medium text-gray-800 dark:text-white">
                                {{ $update->status ?? 'Update' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $update->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $update->note ?? 'No additional notes.' }}
                        </p>
                        @if($update->photos && count($update->photos) > 0)
                            <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($update->photos as $photo)
                                    <img src="{{ Storage::url($photo) }}"
                                         alt="Update photo"
                                         class="rounded-xl object-cover w-full h-32 border border-gray-200 dark:border-gray-700 shadow-sm">
                                @endforeach
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                            Recorded by: {{ $update->user->name ?? 'Unknown' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                No updates yet 🌿
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
    animation: fadeIn 0.6s ease-in-out;
}
</style>
@endsection
