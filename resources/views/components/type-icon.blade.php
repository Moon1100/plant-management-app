@if ($isImage)
    <img src="{{ asset('storage/plant_type_icon/' . $icon) }}"
         alt="icon"
         class="inline w-6 h-6">
@else
    <span class="text-xl">{{ $icon }}</span>

@endif
