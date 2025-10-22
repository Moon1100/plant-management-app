{{-- filepath: /Users/bayam/Documents/web/plant-management/plant-managemet/resources/views/livewire/farm-show.blade.php --}}
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $farm->name }}</h1>
                <p class="text-gray-600 mb-2">📍 {{ $farm->location }}</p>
                <p class="text-gray-700">{{ $farm->description }}</p>
            </div>

            @if($isOwner)
                <div class="flex space-x-2">
                    <a href="{{ route('farms.edit', $farm) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Edit Farm
                    </a>
                    <a href="{{ route('plants.create', ['farm' => $farm]) }}"
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Add Plant
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Plants ({{ $plants->total() }})</h2>

            <div class="flex space-x-4">
                <input wire:model.live="search"
                       type="text"
                       placeholder="Search plants..."
                       class="px-4 py-2 border rounded-lg">

                <select wire:model.live="sortBy" class="px-4 py-2 border rounded-lg">
                    <option value="created_at">Sort by Date</option>
                    <option value="name">Sort by Name</option>
                    <option value="planted_at">Sort by Plant Date</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($plants as $plant)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                    @if($plant->images && count($plant->images) > 0)
                        <img src="{{ Storage::url($plant->images[0]) }}"
                             alt="{{ $plant->name }}"
                             class="w-full h-32 object-cover rounded mb-3">
                    @else
                        <div class="w-full h-32 bg-gray-200 rounded mb-3 flex items-center justify-center">
                            <span class="text-gray-400">🌱</span>
                        </div>
                    @endif

                    <h3 class="font-semibold mb-1">{{ $plant->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $plant->plant_code }}</p>

                    @if($plant->planted_at)
                        <p class="text-xs text-gray-500 mb-2">
                            Planted: {{ $plant->planted_at->format('M d, Y') }}
                        </p>
                    @endif

                    <a href="{{ route('plants.show', $plant->plant_code) }}"
                       class="text-blue-500 hover:text-blue-700 text-sm">
                        View Details →
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No plants found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $plants->links() }}
        </div>
    </div>
</div>
