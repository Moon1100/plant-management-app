{{-- filepath: /Users/bayam/Documents/web/plant-management/plant-managemet/resources/views/livewire/plant-show.blade.php --}}
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $plant->name }}</h1>
                <p class="text-gray-600 mb-2">Code: {{ $plant->plant_code }}</p>
                <p class="text-sm text-gray-500">
                    Farm: <a href="{{ route('farms.show', $plant->farm) }}" class="text-blue-500 hover:text-blue-700">{{ $plant->farm->name }}</a>
                </p>
            </div>

            <div class="flex space-x-2">
                @if($isOwner)
                    <a href="{{ route('plants.edit', $plant->plant_code) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Edit Plant
                    </a>
                @endif

                <button wire:click="toggleQrCode"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    {{ $showQrCode ? 'Hide QR' : 'Show QR' }}
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                @if($plant->types && $plant->types->count() > 0)
                    <div class="mb-4 flex flex-wrap gap-2">
                        @foreach($plant->types as $type)
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">{{ $type->icon ?? '' }} {{ $type->name_en }}</span>
                        @endforeach
                    </div>
                @endif
                @if($plant->images && count($plant->images) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        @foreach($plant->images as $image)
                            <img src="{{ Storage::url($image) }}"
                                 alt="{{ $plant->name }}"
                                 class="w-full h-48 object-cover rounded-lg">
                        @endforeach
                    </div>
                @endif

                <div class="space-y-4">
                    @if($plant->batch)
                        <div>
                            <span class="font-semibold">Batch:</span> {{ $plant->batch }}
                        </div>
                    @endif

                    @if($plant->planted_at)
                        <div>
                            <span class="font-semibold">Planted:</span> {{ $plant->planted_at->format('M d, Y') }}
                        </div>
                    @endif

                    @if($plant->insertion_date)
                        <div>
                            <span class="font-semibold">Inserted:</span> {{ $plant->insertion_date->format('M d, Y') }}
                        </div>
                    @endif

                    @if($plant->notes)
                        <div>
                            <span class="font-semibold">Notes:</span>
                            <p class="mt-1 text-gray-700">{{ $plant->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($showQrCode)
                <div class="text-center">
                    <h3 class="font-semibold mb-4">QR Code</h3>
                    @if($plant->qr_code_url)
                        <img src="{{ $plant->qr_code_url }}"
                             alt="QR Code"
                             class="mx-auto mb-4">
                        <p class="text-sm text-gray-600">Scan to view this plant</p>
                    @else
                        <button wire:click="generateQrCode"
                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Generate QR Code
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <livewire:plant-update-manager :plant="$plant" />
    </div>
</div>
