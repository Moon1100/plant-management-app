<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg">
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm">Name</label>
            <input wire:model="name" type="text" class="w-full px-3 py-2 border rounded" />
        </div>

        <div>
            <label class="block text-sm">Farm</label>
            <select wire:model="farm_id" class="w-full px-3 py-2 border rounded">
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm">Types</label>
            <livewire:type-selector :selected="$type_ids" />
        </div>

        <div>
            <label class="block text-sm">Notes</label>
            <textarea wire:model="notes" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
        </div>

        <div>
            <label class="block text-sm">Existing Images</label>
            <div class="grid grid-cols-3 gap-2 mt-2">
                @foreach($images as $img)
                    <div class="relative">
                        <img src="{{ Storage::url($img) }}" class="w-full h-24 object-cover rounded">
                        <button type="button" wire:click.prevent="removeImage('{{ $img }}')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6">×</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-sm">Add Images</label>
            <input wire:model="newImages" type="file" multiple accept="image/*" class="w-full" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
        </div>
    </form>
</div>
