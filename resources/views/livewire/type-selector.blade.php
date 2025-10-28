<div>
    {{-- 🔍 Search box --}}
    <div class="mb-3">
        <input
            wire:model.debounce.300ms="query"
            type="text"
            placeholder="Search types..."
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-xl
                   bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100
                   focus:ring-2 focus:ring-green-500 focus:outline-none placeholder-gray-400 dark:placeholder-gray-500" />
    </div>

    {{-- 🌱 Type pills --}}
    <div class="flex flex-wrap gap-2 mb-4">
        @forelse($results as $type)
            @php($isSelected = in_array($type->id, $selected))
            <button
                type="button"
                wire:click.prevent="toggle({{ $type->id }})"
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-medium transition-all duration-200
                       border focus:outline-none
                       {{ $isSelected
                            ? 'bg-green-600 border-green-600 text-white hover:bg-green-700'
                            : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span>{{ $type->icon ?? '🌿' }}</span>
                <span>{{ $type->name_my }}</span>
                @if($isSelected)
                    <span class="ml-1 text-xs bg-white/20 px-1.5 py-0.5 rounded-full">✓</span>
                @endif
            </button>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">No types found.</p>
        @endforelse
    </div>

    {{-- ➕ Add new type --}}
    <div class="flex gap-2 mt-3">
        <input
            wire:model.defer="newName"
            type="text"
            placeholder="Add new type..."
            class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-xl
                   bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100
                   focus:ring-2 focus:ring-green-500 focus:outline-none placeholder-gray-400 dark:placeholder-gray-500" />
        <button
            wire:click.prevent="createNew"
            class="px-4 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium transition">
            Add
        </button>
    </div>
</div>
