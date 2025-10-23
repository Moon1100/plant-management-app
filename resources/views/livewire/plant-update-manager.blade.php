<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button wire:click.prevent="switchView('list')" class="px-3 py-1 rounded {{ $viewMode === 'list' ? 'bg-green-600 text-white' : 'bg-gray-100' }}">List</button>
            <button wire:click.prevent="switchView('calendar')" class="px-3 py-1 rounded {{ $viewMode === 'calendar' ? 'bg-green-600 text-white' : 'bg-gray-100' }}">Calendar</button>
        </div>

        <div>
            <span class="text-sm text-gray-500">{{ $plant->updates()->count() }} updates</span>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="text-sm text-green-600">{{ session('message') }}</div>
    @endif

    @if($viewMode === 'list')
        <div class="space-y-4">
            @foreach($updates as $update)
                <div class="border p-4 rounded">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold">{{ $update->title ?? 'Update' }}</h3>
                            <p class="text-xs text-gray-500">{{ $update->recorded_at->format('M d, Y') }} by {{ $update->user->name ?? 'Unknown' }}</p>
                        </div>

                        <div class="flex gap-2">
                            <button wire:click="startEdit({{ $update->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                            <button wire:click="delete({{ $update->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="text-gray-700">{{ $update->description }}</p>
                    </div>

                    @if($update->photos && count($update->photos) > 0)
                        <div class="grid grid-cols-3 gap-2 mt-3">
                            @foreach($update->photos as $photo)
                                <img src="{{ Storage::url($photo) }}" alt="photo" class="w-full h-24 object-cover rounded">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        {{-- Minimal calendar view: simple grouped by date --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($updates->groupBy(fn($u) => $u->recorded_at->toDateString()) as $date => $dayUpdates)
                <div class="border p-3 rounded">
                    <h4 class="font-semibold">{{ \\Illuminate\\Support\\Carbon::parse($date)->format('M d, Y') }}</h4>
                    <ul class="mt-2">
                        @foreach($dayUpdates as $u)
                            <li class="text-sm py-1">{{ $u->title ?? 'Update' }} — {{ $u->recorded_at->format('H:i') }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Create / Edit Form --}}
    <div class="bg-white p-4 rounded border">
        <h3 class="font-semibold mb-2">{{ $editingId ? 'Edit Update' : 'New Update' }}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-700">Title</label>
                <input wire:model="title" type="text" class="w-full px-3 py-2 border rounded" />
            </div>
            <div>
                <label class="block text-sm text-gray-700">Height</label>
                <input wire:model="height" type="text" class="w-full px-3 py-2 border rounded" />
            </div>
        </div>

        <div class="mt-3">
            <label class="block text-sm text-gray-700">Description</label>
            <textarea wire:model="description" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
            <div>
                <label class="block text-sm text-gray-700">Pests</label>
                <input wire:model="pests" type="text" class="w-full px-3 py-2 border rounded" />
            </div>
            <div>
                <label class="block text-sm text-gray-700">Diseases</label>
                <input wire:model="diseases" type="text" class="w-full px-3 py-2 border rounded" />
            </div>
        </div>

        <div class="mt-3">
            <label class="block text-sm text-gray-700">Photos</label>
            <input wire:model="photos" type="file" multiple accept="image/*" class="w-full" />
        </div>

        <div class="flex justify-end gap-2 mt-4">
            @if($editingId)
                <button wire:click.prevent="cancelEdit" class="px-4 py-2 border rounded">Cancel</button>
            @endif
            <button wire:click.prevent="save" class="px-4 py-2 bg-green-600 text-white rounded">{{ $editingId ? 'Save' : 'Create' }}</button>
        </div>
    </div>
</div>
