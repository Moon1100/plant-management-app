{{-- filepath: /Users/bayam/Documents/web/plant-management/plant-managemet/resources/views/livewire/farm-index.blade.php --}}
<div class="space-y-8 animate-fadeIn">
    {{-- Header --}}
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent">
            {{ $isOwnerView ? 'My Farms' : 'All Farms' }}
        </h1>

        @auth
            <div class="flex space-x-3">
                <button wire:click="toggleView"
                    class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-medium shadow hover:scale-105 transform transition-all duration-300">
                    {{ $isOwnerView ? 'View All Farms' : 'My Farms' }}
                </button>
                <a href="{{ route('farms.create') }}"
                   class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-medium shadow hover:scale-105 transform transition-all duration-300">
                    + Create Farm
                </a>
            </div>
        @endauth
    </div>

    {{-- Search --}}
    <div class="relative">
        <input wire:model.live="search"
               type="text"
               placeholder="🔍 Search farms..."
               class="w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-green-300 transition-all duration-300">
    </div>

    {{-- Farms Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($farms as $farm)
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 hover:scale-[1.02] border border-gray-100 dark:border-gray-700">
                <div class="p-6 flex flex-col justify-between h-full">
                    {{-- Farm Name & Location --}}
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2">
                            {{ $farm->name }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 flex items-center space-x-1">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M10 20s8-6.58 8-11A8 8 0 1 0 2 9c0 4.42 8 11 8 11Zm0-9a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z"
                                      clip-rule="evenodd" />
                            </svg>
                            <span>{{ $farm->location }}</span>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-3 leading-relaxed">
                            {{ Str::limit($farm->description, 100) }}
                        </p>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            🌱 {{ $farm->plants_count ?? $farm->plants->count() }} plants
                        </span>
                        <a href="{{ route('farms.show', $farm) }}"
                           class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            View Farm →
                        </a>
                    </div>

                    {{-- Owner Controls --}}
                    @if($isOwnerView)
                        <div class="mt-5 pt-4 border-t border-gray-200 dark:border-gray-700 flex space-x-3">
                            <a href="{{ route('farms.edit', $farm) }}"
                               class="text-sm font-medium text-blue-500 hover:text-blue-700 transition duration-200">
                                ✏️ Edit
                            </a>
                            <a href="{{ route('plants.create', ['farm' => $farm]) }}"
                               class="text-sm font-medium text-green-500 hover:text-green-700 transition duration-200">
                                🌿 Add Plant
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500 text-lg">No farms found 🌾</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8 flex justify-center">
        {{ $farms->links() }}
    </div>
</div>

{{-- Simple Fade Animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.6s ease-in-out;
}
</style>
