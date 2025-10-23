<div class="space-y-4">
    @if(session()->has('message'))
        <div class="text-sm text-green-600">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input wire:model="title" type="text" class="w-full px-3 py-2 border rounded-lg" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Height</label>
            <input wire:model="height" type="text" class="w-full px-3 py-2 border rounded-lg" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description / Observations</label>
        <textarea wire:model="description" rows="4" class="w-full px-3 py-2 border rounded-lg"></textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pests</label>
            <input wire:model="pests" type="text" class="w-full px-3 py-2 border rounded-lg" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Diseases</label>
            <input wire:model="diseases" type="text" class="w-full px-3 py-2 border rounded-lg" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Photos</label>
        <input wire:model="photos" type="file" multiple accept="image/*" class="w-full" />
    </div>

    <div class="flex justify-end">
        <button wire:click.prevent="saveUpdate" class="px-4 py-2 bg-green-600 text-white rounded">Save Update</button>
    </div>
</div>
