<div>
    <div class="mb-2">
        <input wire:model.debounce="query" type="text" placeholder="Search types..." class="w-full px-3 py-2 border rounded" />
    </div>

    <div class="flex flex-wrap gap-2 mb-3">
        @foreach($results as $type)
            @php($isSelected = in_array($type->id, $selected))
            <button type="button" wire:click.prevent="toggle({{ $type->id }})" class="inline-flex items-center gap-2 px-3 py-1 rounded-full border {{ $isSelected ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-800' }}">
                <span class="text-sm">{{ $type->icon ?? '' }} {{ $type->name_en }}</span>
            </button>
        @endforeach
    </div>

    <div class="flex gap-2 mt-2">
        <input wire:model.defer="newName" type="text" placeholder="Add new type" class="px-3 py-2 border rounded w-full" />
        <button wire:click.prevent="createNew" class="px-3 py-2 bg-blue-500 text-white rounded">Add</button>
    </div>
</div>
