<div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 transition-all duration-300 hover:shadow-2xl">
    <form wire:submit.prevent="save" class="space-y-6">
        {{-- 🌱 Plant Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Plant Name *</label>
            <input
                wire:model.defer="name"
                type="text"
                placeholder="Enter plant name..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl
                       bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- 🏡 Farm --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Farm *</label>
            <select
                wire:model.defer="farm_id"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl
                       bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option value="">Select a farm...</option>
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
            </select>
            @error('farm_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- 🧩 Types (Pill Selector) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Types</label>
            <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <livewire:type-selector :selected="$type_ids" />
            </div>
        </div>

        {{-- 📝 Notes --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
            <textarea
                wire:model.defer="notes"
                rows="4"
                placeholder="Write details about this plant..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl
                       bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>
            @error('notes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- 🌄 Existing Images --}}
        {{-- @if($images && count($images))
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Existing Images</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($images as $img)
                        <div class="relative group">
                            <img src="{{ Storage::url($img) }}"
                                 class="w-full h-28 object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <button
                                type="button"
                                wire:click.prevent="removeImage('{{ $img }}')"
                                class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6
                                       flex items-center justify-center text-xs font-bold opacity-90 hover:opacity-100">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif --}}

        {{-- 📸 Add Images --}}
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add Images</label>
            <input
                wire:model="newImages"
                type="file"
                multiple
                accept="image/*"
                class="block w-full text-sm text-gray-700 dark:text-gray-200
                       border border-gray-300 dark:border-gray-700 rounded-xl
                       file:mr-4 file:py-2 file:px-4 file:rounded-xl
                       file:border-0 file:bg-green-600 file:text-white
                       hover:file:bg-green-700 transition cursor-pointer bg-gray-50 dark:bg-gray-800">
            @error('newImages.*') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

            @if($newImages)
                <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($newImages as $img)
                        <img src="{{ $img->temporaryUrl() }}" class="w-full h-28 object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    @endforeach
                </div>
            @endif
        </div> --}}

        {{-- 💾 Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('plants.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                Cancel
            </a>
            <button
                type="submit"
                class="px-5 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium transition">
                Save Plant
            </button>
        </div>
    </form>
</div>
