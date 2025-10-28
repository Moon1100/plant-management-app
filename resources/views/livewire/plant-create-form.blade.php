<div class="max-w-5xl mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 animate-fadeIn transition-all duration-300 hover:shadow-2xl">

    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-2">🌱 Create New Plant</h1>

    <form wire:submit.prevent="save" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plant Name <span class="text-red-500">*</span></label>
                <input wire:model="name" type="text" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Farm <span class="text-red-500">*</span></label>
                <select wire:model="farm_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Select Farm</option>
                    @foreach($farms as $farm)
                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                </select>
                @error('farm_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Batch</label>
                <input wire:model="batch" type="text" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('batch') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Planted Date</label>
                <input wire:model="planted_at" type="date" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('planted_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
            <textarea wire:model="notes" rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Types / Tags</label>
            <livewire:type-selector :selected="$type_ids" />
            <p class="text-xs text-gray-500 mt-2">Search and select types. Add a new type inline if it doesn't exist.</p>
        </div>
{{-- 
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Images</label>
            @if($newImages)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @foreach($newImages as $index => $image)
                        <div class="relative group">
                            <img src="{{ $image->temporaryUrl() }}" alt="New image" class="w-full h-28 object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <button type="button" wire:click="removeNewImage({{ $index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-90 group-hover:opacity-100">×</button>
                        </div>
                    @endforeach
                </div>
            @endif

            <input wire:model="newImages" type="file" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('newImages.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div> --}}

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('farms.index') }}" class="px-5 py-2 border border-gray-300 dark:border-gray-700 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition">Cancel</a>
            <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition">Create Plant</button>
        </div>
    </form>

</div>
