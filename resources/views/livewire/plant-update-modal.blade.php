<div class=" dark:bg-gray-900 w-full max-w-lg  shadow-2xl p-6 relative animate-fadeIn">

    {{-- Close button --}}
    <button wire:click="close"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
        ✖
    </button>

    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
        Add Plant Update
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" wire:model.defer="title"
                class="w-full mt-1 px-3 py-2 border rounded-xl bg-gray-50 dark:bg-gray-800
                       border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <input type="text" wire:model.defer="status"
                class="w-full mt-1 px-3 py-2 border rounded-xl bg-gray-50 dark:bg-gray-800
                       border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea rows="3" wire:model.defer="description"
                class="w-full mt-1 px-3 py-2 border rounded-xl bg-gray-50 dark:bg-gray-800
                       border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>
            @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recorded At</label>
            <input type="date" wire:model.defer="recorded_at"
                class="w-full mt-1 px-3 py-2 border rounded-xl bg-gray-50 dark:bg-gray-800
                       border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100
                       focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('recorded_at') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photos</label>
            <input type="file" multiple wire:model="photos" accept="image/*"
                class="mt-1 w-full text-sm text-gray-700 dark:text-gray-200">
            @error('photos.*') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

            @if($photos)
                <div class="mt-3 grid grid-cols-3 gap-3">
                    @foreach($photos as $photo)
                        <img src="{{ $photo->temporaryUrl() }}"
                             class="w-full h-24 object-cover rounded-xl border border-gray-300 dark:border-gray-700">
                    @endforeach
                </div>
            @endif
        </div> --}}

        <div class="flex justify-end gap-3 pt-3">
            <button type="button" wire:click="close"
                class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700
                       text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                Cancel
            </button>
            <button type="submit"
                class="px-4 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium">
                Save
            </button>
        </div>
    </form>
<style>
@keyframes fadeIn {
    from {opacity:0;transform:translateY(10px)}
    to {opacity:1;transform:translateY(0)}
}
.animate-fadeIn{animation:fadeIn .4s ease-in-out}
</style>
</div>


