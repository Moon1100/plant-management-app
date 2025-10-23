@props(['plant'])

<div class="group flex flex-col bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
    <div class="relative w-full aspect-[4/3] overflow-hidden rounded-t-2xl">
        @if($plant->images && count($plant->images) > 0)
            <img src="{{ Storage::url($plant->images[0]) }}" alt="{{ $plant->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-t-2xl">
        @else
            <div class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-3xl rounded-t-2xl">🌿</div>
        @endif
    </div>

    <div class="flex-1 flex flex-col p-4 rounded-b-2xl">
        <h3 class="font-semibold text-lg text-gray-800 dark:text-white group-hover:text-green-500 transition-colors duration-300">{{ $plant->name }}</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $plant->plant_code }}</p>
        <div class="mt-auto flex items-center space-x-3">
            <a href="{{ route('public.plants.show', $plant->plant_code) }}" class="text-sm font-medium text-green-600 dark:text-green-400 hover:underline" aria-label="View {{ $plant->name }}">View →</a>

            @if(auth()->check() && auth()->id() === $plant->farm->user_id)
                <a href="{{ route('plants.edit', $plant) }}" class="text-sm px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-700 dark:text-gray-200 hover:bg-gray-200">Edit</a>
            @endif
        </div>
    </div>
</div>
